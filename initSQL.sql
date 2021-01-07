CREATE DATABASE IF NOT EXISTS webproject;

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
INSERT INTO `tecaher`(`email`, `username`, `password`) VALUES ("teacher1@example.com", "Teacher 1", "12345678");
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
ALTER TABLE tutorial 
    ADD CONSTRAINT category_id
    FOREIGN KEY (category_id)
    REFERENCES tutorial_categeory(id);


-- Adding the Foregin Key reference from "tutorial" to "teacher"
ALTER TABLE teacher ENGINE=InnoDB; 
ALTER TABLE tutorial 
    ADD CONSTRAINT instructor
    FOREIGN KEY (instructor)
    REFERENCES teacher(email);

-- Populating the "tutorial" table
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`) VALUES (1, "teacher1@example.com", "This is the FirstTutorial")
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`) VALUES (1, "teacher2@example.com", "This is the Second Tutorial")

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