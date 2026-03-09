<?php
session_start();
require_once __DIR__ . '/config.php';

$apiKey = trim((string) (getenv('DEEPSEEK_API_KEY') ?: API_KEY));
if (!isset($_SESSION['chat_history']) || !is_array($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset_chat'])) {
        $_SESSION['chat_history'] = [];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    $message = trim($_POST['message'] ?? '');

    if ($message === '') {
        $error = 'Please enter a message.';
    } elseif (empty($apiKey)) {
        $error = 'DeepSeek API key is missing. Update config.php or set DEEPSEEK_API_KEY.';
    } else {
        $_SESSION['chat_history'][] = [
            'role' => 'user',
            'text' => $message,
        ];

        // Build messages array for DeepSeek (similar to OpenAI format)
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are a helpful, concise assistant for a core PHP demo chatbot.'
            ]
        ];

        // Add recent conversation history (last 12 messages)
        $recentTurns = array_slice($_SESSION['chat_history'], -12);
        foreach ($recentTurns as $turn) {
            $messages[] = [
                'role' => $turn['role'],
                'content' => $turn['text']
            ];
        }

        // DeepSeek API payload
        $payload = [
            'model' => DEEPSEEK_MODEL,
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens' => 2000,
            'stream' => false
        ];

        // Initialize cURL for DeepSeek API
        $ch = curl_init(DEEPSEEK_API_URL);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ],
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_TIMEOUT => 30,
        ]);

        $result = curl_exec($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr = curl_error($ch);
        curl_close($ch);

        if ($result === false) {
            $error = 'Network error: ' . ($curlErr ?: 'Unknown cURL error.');
        } else {
            $decoded = json_decode($result, true);

            if ($httpCode >= 400) {
                $apiErr = $decoded['error']['message'] ?? 'API request failed.';
                $error = 'DeepSeek error (' . $httpCode . '): ' . $apiErr;
            } else {
                // Extract assistant message from DeepSeek response
                $assistantText = $decoded['choices'][0]['message']['content'] ?? '';

                if ($assistantText === '') {
                    $error = 'No readable reply received from DeepSeek API.';
                } else {
                    $_SESSION['chat_history'][] = [
                        'role' => 'assistant',
                        'text' => $assistantText,
                    ];
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit;
                }
            }
        }
    }
}

// Rest of your code remains exactly the same...
$chatHistory = $_SESSION['chat_history'];

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP AI Chatbot - DeepSeek</title>
    <!-- Your existing styles remain exactly the same -->
    <style>
        /* Copy all your existing CSS styles here - they remain unchanged */
        :root {
            --bg-a: #f8fff8;
            --bg-b: #eff6ff;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #475569;
            --accent: #0f766e;
            --accent-2: #2563eb;
            --user: #dbeafe;
            --bot: #dcfce7;
            --danger: #b91c1c;
            --border: #e2e8f0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 20%, #ccfbf1 0%, transparent 36%),
                radial-gradient(circle at 85% 15%, #dbeafe 0%, transparent 40%),
                linear-gradient(135deg, var(--bg-a), var(--bg-b));
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .app {
            width: min(920px, 100%);
            height: min(88vh, 760px);
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
            overflow: hidden;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        .topbar {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: linear-gradient(90deg, rgba(15,118,110,0.08), rgba(37,99,235,0.08));
        }

        .title {
            margin: 0;
            font-size: 1.1rem;
            letter-spacing: 0.2px;
        }

        .subtitle {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.88rem;
        }

        .reset-btn {
            border: 1px solid var(--border);
            background: #fff;
            color: var(--text);
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .messages {
            padding: 18px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
        }

        .bubble {
            max-width: 78%;
            padding: 12px 14px;
            border-radius: 14px;
            line-height: 1.5;
            white-space: pre-wrap;
            word-break: break-word;
            border: 1px solid var(--border);
            animation: rise 0.25s ease;
        }

        .user {
            align-self: flex-end;
            background: var(--user);
            border-top-right-radius: 4px;
        }

        .assistant {
            align-self: flex-start;
            background: var(--bot);
            border-top-left-radius: 4px;
        }

        .empty {
            margin: auto;
            text-align: center;
            color: var(--muted);
            max-width: 480px;
        }

        .error {
            margin: 0 18px 12px;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: var(--danger);
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 0.92rem;
        }

        .composer {
            border-top: 1px solid var(--border);
            padding: 14px;
            background: #fcfdff;
        }

        .composer form {
            display: flex;
            gap: 10px;
        }

        .composer input {
            flex: 1;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 1rem;
            outline: none;
        }

        .composer input:focus {
            border-color: var(--accent-2);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.14);
        }

        .send-btn {
            border: none;
            border-radius: 12px;
            padding: 0 18px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 680px) {
            body { padding: 10px; }
            .app { height: 94vh; border-radius: 14px; }
            .bubble { max-width: 90%; }
            .composer form { flex-direction: column; }
            .send-btn { height: 44px; }
        }
    </style>
</head>
<body>
    <main class="app">
        <header class="topbar">
            <div>
                <h1 class="title">AI Chatbot</h1>
                <p class="subtitle">PHP + DeepSeek API</p> <!-- Updated subtitle -->
            </div>
            <form method="post">
                <input type="hidden" name="reset_chat" value="1">
                <button class="reset-btn" type="submit">Clear Chat</button>
            </form>
        </header>

        <section class="messages" id="chatMessages">
            <?php if (!$chatHistory): ?>
                <div class="empty">
                    <h3>Start a conversation with DeepSeek</h3>
                    <p>Ask coding, writing, business, or daily questions. This chat keeps recent context during your session.</p>
                </div>
            <?php else: ?>
                <?php foreach ($chatHistory as $turn): ?>
                    <article class="bubble <?= $turn['role'] === 'user' ? 'user' : 'assistant' ?>">
                        <?= nl2br(h($turn['text'])) ?>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <?php if ($error !== ''): ?>
            <div class="error"><?= h($error) ?></div>
        <?php endif; ?>

        <footer class="composer">
            <form method="post" autocomplete="off">
                <input
                    type="text"
                    name="message"
                    id="message"
                    placeholder="Type your message..."
                    required
                    autofocus
                >
                <button class="send-btn" type="submit">Send</button>
            </form>
        </footer>
    </main>

    <script>
        const chat = document.getElementById('chatMessages');
        if (chat) {
            chat.scrollTop = chat.scrollHeight;
        }
    </script>
</body>
</html>