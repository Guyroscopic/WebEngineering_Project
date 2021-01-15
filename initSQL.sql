CREATE DATABASE IF NOT EXISTS webproject;

DROP TABLE student;
DROP TABLE teacher;
DROP TABLE tutorial;
DROP TABLE tutorial_categeory;
DROP TABLE paragraph;
DROP TABLE quiz;
DROP TABLE question;
DROP TABLE student_tutorial_bridge;

CREATE TABLE IF NOT EXISTS student(
			
	    email VARCHAR(100) NOT NULL PRIMARY KEY,
	    username VARCHAR(100) NOT NULL,
	    password VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS teacher(
			
	    email VARCHAR(100) NOT NULL PRIMARY KEY,
	    username VARCHAR(100) NOT NULL,
	    password VARCHAR(100) NOT NULL
);

INSERT INTO `student`(`email`, `username`, `password`) VALUES ("rafey@example.com",   "Abdul Rafey",   "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("laraib@example.com",  "Laraib Chuss",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("fatima@example.com",  "Fatima Aunty",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("ghazala@example.com", "Qatil Haseena", "12345678");

INSERT INTO `teacher`(`email`, `username`, `password`) VALUES ("teacher1@example.com", "Teacher 1", "12345678");
INSERT INTO `teacher`(`email`, `username`, `password`) VALUES ("teacher3@example.com", "Teacher 3", "12345678");
INSERT INTO `teacher`(`email`, `username`, `password`) VALUES ("teacher2@example.com", "Teacher 2", "12345678");

-- Creating and populating the "tutorial_category" table
CREATE TABLE `webproject`.`tutorial_categeory` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `tutorial_categeory`(`name`) VALUES ("programming");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("arts");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("maths");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("biology");


-- Creating the "tutorial" table
CREATE TABLE `webproject`.`tutorial` ( `id` INT NOT NULL AUTO_INCREMENT , `category_id` INT NOT NULL , `instructor` VARCHAR(100) NOT NULL , `title` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding the Foregin Key reference from "tutorial" to "tutorial_category"
ALTER TABLE `tutorial` ADD `description` VARCHAR(1000) NOT NULL AFTER `title`;
ALTER TABLE `tutorial` ADD `video` VARCHAR(100) NULL AFTER `description`;
ALTER TABLE tutorial 
    ADD CONSTRAINT category_id
    FOREIGN KEY (category_id)
    REFERENCES tutorial_categeory(id);


-- Adding the Foregin Key reference from "tutorial" to "teacher"
ALTER TABLE teacher ENGINE=InnoDB; 
ALTER TABLE student ENGINE=InnoDB;
ALTER TABLE tutorial 
    ADD CONSTRAINT instructor
    FOREIGN KEY (instructor)
    REFERENCES teacher(email);

-- Populating the "tutorial" table
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, "teacher1@example.com", "This is the FirstTutorial", "Description")
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, "teacher2@example.com", "This is the Second Tutorial", "Description")

-- Creating the "paragraph" table
CREATE TABLE `webproject`.`paragraph` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `heading` VARCHAR(100) NOT NULL , `content` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB

-- Adding the Foregin Key reference from "paragraph "to "tutorial"
ALTER TABLE paragraph
    ADD CONSTRAINT tutorial_id
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id);

-- Populating the "paragraph" table
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1 , "Heading - 1", "This is the content of paragraph 1, this paragraph is a part of tutorial 1");
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1 , "Heading - 2", "This is the content of paragraph 2, this paragraph is a part of tutorial 1");
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2 , "Heading - 1", "This is the content of paragraph 1 of tutorial 2");
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2 , "Heading - 2", "This is the content of paragraph 2 of tutorial 2");

-- Creating the "quiz" table
CREATE TABLE `webproject`.`quiz` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding the Foregin Key reference from "quiz "to "tutorial"
ALTER TABLE `quiz` ADD `topic` VARCHAR(100) NOT NULL AFTER `tutorial_id`;
ALTER TABLE quiz
    ADD CONSTRAINT tutorial_id_inQuiz
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id);

-- Creating the "question" table
CREATE TABLE `webproject`.`question` ( `id` INT NOT NULL AUTO_INCREMENT , `quiz_id` INT NOT NULL , `statement` VARCHAR(1000) NOT NULL , `option1` VARCHAR(100) NOT NULL , `option2` VARCHAR(100) NOT NULL , `option3` VARCHAR(100) NULL , `option4` VARCHAR(100) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding the Foregin Key reference from "question "to "question"
ALTER TABLE `question` ADD `correct_option` VARCHAR(100) NOT NULL AFTER `option4`;
ALTER TABLE question
    ADD CONSTRAINT quiz_id_inQuestion
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id);

-- Creating the "student_tutorial_bridge" table
CREATE TABLE `webproject`.`student_tutorial_bridge` ( `student_email` VARCHAR(100) NOT NULL , `tutorial_id` INT NOT NULL , `tutorial_rating` INT NOT NULL ) ENGINE = InnoDB;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "student"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT tutorial_email_inSTB
    FOREIGN KEY (student_email)
    REFERENCES student(email);
-- Adding the Foregin Key reference from "student_tutorial_bridge "to "tutorial"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT tutorial_id_inSTB
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id);

-- Making the Composite Primary Key in "student_tutorial_bridge"
ALTER TABLE `student_tutorial_bridge` ADD PRIMARY KEY( `student_email`, `tutorial_id`);

-- Creating the "admin" table
CREATE TABLE `webproject`.`admin` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Populating the "admin" table
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin1@example.com', 'Admin 1', '12345678');
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin2@example.com', 'Admin 2', '12345678');