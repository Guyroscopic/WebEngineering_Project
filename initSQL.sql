CREATE DATABASE IF NOT EXISTS webproject;

CREATE TABLE IF NOT EXISTS student(
			
		email VARCHAR(100) NOT NULL PRIMARY KEY,
	    username varchar(100) NOT NULL,
	    password varchar(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS teacher(
			
		email VARCHAR(100) NOT NULL PRIMARY KEY,
	    username varchar(100) NOT NULL,
	    password varchar(100) NOT NULL
);

INSERT INTO `student`(`email`, `username`, `password`) VALUES ("rafey@example.com",   "Abdul Rafey",   "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("laraib@example.com",  "Laraib Chuss",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("fatima@example.com",  "Fatima Aunty",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("ghazala@example.com", "Qatil Haseena", "12345678");

INSERT INTO `tecaher`(`email`, `username`, `password`) VALUES ("teacher1@example.com", "Teacher 1", "12345678");
INSERT INTO `teacher`(`email`, `username`, `password`) VALUES ("teacher2@example.com", "Teacher 2", "12345678");