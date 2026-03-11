/* Create Databse */
CREATE DATABASE php-laravel;

/* SHOW DB */ /* VIEW All Databse */
SHOW DATABASES;

/* View Single DAtabse */
USE STUDENT;

/* Create Table in DATABSE  */
CREATE TABLE users (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* READ */
/*View All Users Query:*/ 
SELECT * FROM `Users`;

/* CREATE */
/* INSER SINGLE USER Using Query*/ 
INSERT INTO Users (name,email,password) VALUES ('Aasif','aasif@gmail.com','786'), ('Kirtan','dhola@123gmail.com','12345');

/* SINGLE DATA Fatch */
SELECT * FROM `users` WHERE id=1;
SELECT * FROM `users` WHERE name="Aasif";
SELECT * FROM `users` WHERE email="aasif@gmail.com";
SELECT * FROM `users` WHERE password='786';

/* fatch Data using name and id */
SELECT * FROM users WHERE u_name='Dharmik' AND id=1;

SELECT * FROM users WHERE name='Dharmik' OR name='none';

/* single record in Fatch database  */
-- particular Key to Data Find
SELECT name,email FROM Users;

/*UPDATE*/
-- Update a single Record in Database
UPDATE Users SET name='Aasif132',email='aasif@gmail.com',password='123456' WHERE id=8;

/* DELETE */ 

-- Delete a single record's Using ID
DELETE FROM EMP WHERE ID=6;

/* Constraints */
CREATE TABLE emp (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
age INT NOT NULL CHECK(AGE>=18),
phone VARCHAR(15) UNIQUE,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

/* Inser DATA IN DATABSE */
INSERT INTO EMP (NAME,AGE,PHONE,EMAIL,PASSWORD) VALUES ('Aasif',27,'9874512360','aasif@gmail.com','786'), ('Kirtan',25,'6312369785','dhola@123gmail.com','12345');

/* AND, OR  */
SELECT * FROM EMP WHERE AGE<=25 OR PASSWORD='123456';
SELECT * FROM EMP WHERE AGE>=23 OR AGE<=25; 

/* Between */
SELECT * FROM EMP WHERE AGE BETWEEN 18 AND 25;
SELECT * FROM EMP WHERE AGE NOT BETWEEN 18 AND 25;

/* LIKE Opretor*/

-- LIKE opretor are use for data searching and Filter's
SELECT * FROM EMP WHERE NAME LIKE "%a%";
/* NOT LIKE */

-- NOR LIKE OPRECTOR ARE NOT A ALTERNET DATA SHOW
SELECT * FROM EMP WHERE NAME NOT LIKE "%a%";

/* Regular Expression */

-- ALL RECORD SERCHE AND FATCH A JOINT TEXT A AR IN SINGLE WORD
SELECT * FROM EMP WHERE NAME REGEXP 'AR';
-- Starting text a A;
SELECT * FROM EMP WHERE NAME REGEXP '^A';
-- end test in A
SELECT * FROM EMP WHERE NAME REGEXP 'A$';
-- database ma jya pan hase tyathi data llavse pachi te row ni starting ma hoy ke Ending  
SELECT * FROM EMP WHERE NAME REGEXP 'variya|khan|kirtan';

/*  ORDER BY & DISTINCT */

-- ASC and DESC
SELECT * FROM EMP ORDER BY NAME; -- ORDER BY NAME

SELECT * FROM EMP ORDER BY NAME DESC; -- DECS ORDER BY NAME

SELECT * FROM EMP ORDER BY AGE; -- ORDER BY AGE

SELECT * FROM EMP ORDER BY AGE DESC; -- ORDER BY AGE

/*  IS NULL & IS NOT NULL */

-- PHONE NA colum ni adar jya pan null value hase ek data (row) show thase.
SELECT * FROM EMP WHERE phone is null;
-- JEMA PAN NULL VALUE HASE E ROW NE SHODI NE BADHAJ DATA NE VIEW KARSE
SELECT * FROM EMP WHERE phone is NOT NULL;

/* LIMIT & OFFSET */

-- DATA LIMIT SET MAXIMUL DATA VIEW 
SELECT * FROM EMP WHERE phone LIMIT 3;
-- kaya number na row th start karvanu che E.
SELECT * FROM EMP WHERE phone LIMIT 2,3;

/* Count Sum Min Max Avg */

SELECT MAX(AGE) FROM emp; -- Maximum Age Found in table
SELECT MIN(AGE) FROM emp; -- Miinimum Age found in Table
SELECT SUM(AGE) FROM emp; -- Total sum Of Age
SELECT SUM(AGE) FROM emp; -- Total sum Of AVAREAGE.

/* COMMIT & ROLLBACK */

select * from EMP;
COMMIT;
UPDATE EMP SET name='Aasif132',AGE='28',PHONE='231465789',email='aasif123@gmail.com',password='123457' WHERE id=5;
ROLLBACK;

/*  PRIMARY KEY & FOREIGN KEY */
