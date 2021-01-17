-- Creating "webproject_new" Database
DROP DATABSE IF EXISTS webproject_new;

-- Using the Database
USE webproject_new;

-- Creating "student" Table
CREATE TABLE `webproject_new`.`student` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "teacher" Table
CREATE TABLE `webproject_new`.`teacher` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `education` VARCHAR(1000) NOT NULL , `description` VARCHAR(1000) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "admin" Table
CREATE TABLE `webproject_new`.`admin` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "tutorial_catageory" Table
CREATE TABLE `webproject_new`.`tutorial_categeory` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "tutorial" Table
CREATE TABLE `webproject_new`.`tutorial` ( `id` INT NOT NULL AUTO_INCREMENT , `category_id` INT NOT NULL , `instructor` VARCHAR(100) NOT NULL , `title` VARCHAR(100) NOT NULL , `description` VARCHAR(1000) NOT NULL , `video` VARCHAR(100) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "paragraph" Table
CREATE TABLE `webproject_new`.`paragraph` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `heading` VARCHAR(100) NOT NULL , `content` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "quiz" Table
CREATE TABLE `webproject_new`.`quiz` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `topic` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "question" Table
CREATE TABLE `webproject_new`.`question` ( `id` INT NOT NULL AUTO_INCREMENT , `quiz_id` INT NOT NULL , `statement` VARCHAR(1000) NOT NULL , `option1` VARCHAR(100) NOT NULL , `option2` VARCHAR(100) NOT NULL , `option3` VARCHAR(100) NULL , `option4` VARCHAR(100) NULL , `correct_option` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_tutorial_bridge" Table
CREATE TABLE `webproject_new`.`student_tutorial_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `tutorial_id` INT NOT NULL , `tutorial_rating` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_quiz_bridge" Table
CREATE TABLE `webproject_new`.`student_quiz_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `quiz_id` INT NOT NULL , `quiz_score` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding Foregin Key Reference from "tutorial" to "tutorial_catageory"
ALTER TABLE tutorial 
    ADD CONSTRAINT category_id_inTuorial
    FOREIGN KEY (category_id)
    REFERENCES tutorial_categeory(id)
    ON DELETE CASCADE;

-- Adding Foregin Key Reference from "tutorial" to "teacher"
ALTER TABLE tutorial 
    ADD CONSTRAINT instructor_inTuorial
    FOREIGN KEY (instructor)
    REFERENCES teacher(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "paragraph "to "tutorial"
ALTER TABLE paragraph
    ADD CONSTRAINT tutorial_id_inParagraph
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "quiz "to "tutorial"
ALTER TABLE quiz
    ADD CONSTRAINT tutorial_id_inQuiz
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "question "to "quiz"
ALTER TABLE question
    ADD CONSTRAINT quiz_id_inQuestion
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "student"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT student_email_inSTB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "tutorial"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT tutorial_id_inSTB
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "student"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT student_email_inSQB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "quiz"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT quiz_id_inSQB
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Populating "student" Table
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("rafey@example.com",   "Abdul Rafey",   "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("laraib@example.com",  "Laraib Arjamand",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("fatima@example.com",  "Fatima Khalid",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("ghazala@example.com", "Ghazala Bibi", "12345678");

-- Populating "teacher" Table
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("qaiser@example.com", "Qaiser Riaz",     "12345678", "PhD in xyz, From abc University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Web Development to 2nd and 3rd Year Students.");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("tofeeq@example.com", "Tofeq ur Rehman", "12345678", "PhD in qwe, From def University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Computer Organization and Operating Systems to 2nd and 3rd Year Students.");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("hammad@example.com", "Hammad Ahmed",    "12345678", "MS in pop, From qwerty University", "I am a Professor at NUST, Islamabad, Pakistan. I teach Machine Learning to 2nd and 3rd Year Students.");

-- Populating "admin" Table
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin1@example.com', 'Admin 1', '12345678');
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin2@example.com', 'Admin 2', '12345678');

-- Populating "tutorial_catageory" Table
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Programming");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Arts");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Maths");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Biology");

--Populating "tutorial" Table


--Populating "paragraph" Table


--Populating "quiz" Table


--Populating "question" Table


--Populating "student_tutorial_bridge" Table


--Populating "student_quiz_bridge"Table



