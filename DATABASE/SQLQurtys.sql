/* Create Databse */
CREATE DATABASE php-laravel;

/* SHOW DB */ /* VIEW All Databse */
SHOW DATABASES;

/* View Single DAtabse */
USE STUDENT;

/* Create Table in DATABSE  */
CREATE TABLE admin (
ad_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
ad_name VARCHAR(100),
ad_email VARCHAR(100) NOT NULL UNIQUE,
ad_password VARCHAR(255),
ad_city VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admin (ad_name,ad_email,ad_password,ad_city) VALUES ('Aasif','aasif@gmail.com','786','surat'), ('Kirtan','dhola@123gmail.com','12345','Bhopal');
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

/*  PRIMARY KEY */
-- CREATE NEW TABLE AN USING PRIMARY KEY
CREATE TABLE emp (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
age INT NOT NULL CHECK(AGE>=18),
phone VARCHAR(15) UNIQUE,
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (ID),
);
-- jo table pahle thi create hoy to aa cammand no use thay che,
ALTER TABLE EMP ADD PRIMARY KEY (id);

/* FOREIGN KEY */
-- Create a New Table using foreign key
CREATE TABLE emp (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
age INT NOT NULL CHECK(AGE>=18),
phone VARCHAR(15) UNIQUE,
admin_id int(15),
email VARCHAR(255) NOT NULL UNIQUE,
password VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 -- REFRENCE LEY CHE User Table Mathi U_id Mathi Name Filed
);
-- jo table pahle thi create hoy to aa cammand no use thay che,
ALTER TABLE EMP ADD FOREIGN KEY (admin_id) REFERENCES admin(ad_id);

ALTER TABLE EMP ADD admin_id int(15),

INSERT INTO EMP (name,age,phone,admin_id,email,password) VALUES ('Aasif','28','9874561235','2','aasif@gmail.com','786'), ('Kirtan','23','9874651235','1','dhola@123gmail.com','12345');

/* INNER JOIN */
-- Two table to data Show.
SELECT * FROM ADMIN A INNER JOIN EMP E ON A.AD_ID = E.CITY;
-- view a Selected filad in Table
SELECT e.id,e.name,e.age,e.phone,e.city,e.email,e.password,a.ad_city FROM ADMIN A INNER JOIN EMP E ON A.AD_ID = E.CITY WHERE ad_city= 'surat';
-- With INNER TEXT TO USE A QUERY AND CONDITION RUN.
SELECT e.id,e.name,e.age,e.phone,e.city,e.email,e.password,a.ad_city FROM ADMIN A JOIN EMP E ON A.AD_ID = E.CITY WHERE ad_city= 'surat';

/* LEFT JOIN */
SELECT emp.id,emp.name,emp.age,emp.phone,emp.admin_id,emp.email,emp.password,admin.ad_city FROM emp LEFT JOIN admin ON emp.admin_id = admin.ad_id; -- left join using clounm name

/* RIGHT JOIN */
SELECT * FROM ADMIN RIGHT JOIN EMP ON ADMIN.AD_ID = EMP.ADMIN_ID;-- Right join Using With out colunm name

/* CROSS JOIN */
SELECT * FROM EMP CROSS JOIN ADMIN;

/* Multiple JOIN */

-- New Table Create
CREATE TABLE work (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
w_name VARCHAR(255),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Multiple data Insert.
INSERT INTO WORK (W_NAME) VALUES('excel'),('data listing'),('devlopment'),('devoops');
ALTER TABLE EMP ADD FOREIGN KEY (work_id) REFERENCES work(w_id);
/* Multiple JOIN */
-- TWO OR MORE THAN TABLE TO DATA FACHINMG USE
SELECT * FROM EMP INNER JOIN ADMIN ON EMP.ADMIN_ID = ADMIN.AD_ID INNER JOIN WORK ON EMP.WORK_ID = WORK.W_ID;

/* Group By */
SELECT work_id, COUNT(work_id) FROM emp GROUP BY work_id;

/* HAVING Clause */

SELECT admin_id, COUNT(*) AS total_employee FROM emp GROUP BY admin_id HAVING COUNT(*) > 2;

/* SubQuery */
-- FIND DATA USING NAME FILED
SELECT name FROM emp WHERE work_id = ( SELECT w_id FROM work WHERE w_name = "devoops");

/* UNION */
-- Same datatype ane same colum hovi joy ye abbe same order ma. 
SELECT EMP.ID , EMP.NAME FROM EMP UNION SELECT WORK.W_ID,WORK.W_NAME FROM WORK;
/* UNION ALL */
SELECT EMP.ID , EMP.NAME FROM EMP UNION ALL SELECT WORK.W_ID,WORK.W_NAME FROM WORK;
