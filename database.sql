-- Drop tables to refresh the database
DROP TABLE IF EXISTS `Allow`;
DROP TABLE IF EXISTS `Phone`;
DROP TABLE IF EXISTS `Experience`;
DROP TABLE IF EXISTS `Education`;
DROP TABLE IF EXISTS `Address`;
DROP TABLE IF EXISTS `Skill`;
DROP TABLE IF EXISTS `CV`;
DROP TABLE IF EXISTS `user`;

-- Create tables
CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL DEFAULT '',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `CV` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL DEFAULT '',
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    `job` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL DEFAULT '',
    `introduction` VARCHAR(255) NOT NULL DEFAULT '',
    `other` VARCHAR(255) NOT NULL DEFAULT '',
    `ref_email` VARCHAR(100) NOT NULL DEFAULT '',
    `ref_Phone` VARCHAR(30) NOT NULL DEFAULT '',
    `color` VARCHAR(8) NOT NULL DEFAULT '#000000',
    `password` VARCHAR(255) NOT NULL DEFAULT '',
    `access_level` ENUM('1', '2', '3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
    `owner` INT NOT NULL,
    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `Allow` (
    `user_id` INT NOT NULL,
    `CV_id` INT NOT NULL,
    PRIMARY KEY (`user_id`, `CV_id`)
) ENGINE = InnoDB;

CREATE TABLE `Education` (
    `CV_id` INT NOT NULL,
    `university` VARCHAR(100) NOT NULL DEFAULT '',
    `major` VARCHAR(100) NOT NULL DEFAULT '',
    `degree` VARCHAR(255) NOT NULL DEFAULT '',
    `gpa` FLOAT NOT NULL DEFAULT '0.0',
    `start_year` SMALLINT NOT NULL DEFAULT '1900',
    `end_year` SMALLINT NOT NULL DEFAULT '1900',
    PRIMARY KEY (`CV_id`, `university`, `major`, `degree`, `gpa`, `start_year`, `end_year`)
) ENGINE = InnoDB;

CREATE TABLE `Experience` (
    `CV_id` INT NOT NULL,
    `job` VARCHAR(50) NOT NULL DEFAULT '',
    `company` VARCHAR(100) NOT NULL DEFAULT '',
    `employer` VARCHAR(50) NOT NULL DEFAULT '',
    `description` VARCHAR(255) NOT NULL DEFAULT '',
    `start_year` SMALLINT NOT NULL DEFAULT '1900',
    `end_year` SMALLINT NOT NULL DEFAULT '1900',
    PRIMARY KEY (`CV_id`, `job`, `company`, `employer`, `description`, `start_year`, `end_year`)
) ENGINE = InnoDB;

CREATE TABLE `Phone` (
    `CV_id` INT NOT NULL,
    `number` VARCHAR(20) NOT NULL DEFAULT '111122223333',
    PRIMARY KEY (`CV_id`, `number`)
) ENGINE = InnoDB;

CREATE TABLE `Skill` (
    `CV_id` INT NOT NULL,
    `name` VARCHAR(255) NOT NULL DEFAULT '',
    `year` SMALLINT NOT NULL DEFAULT '0',
    PRIMARY KEY (`CV_id`, `name`, `year`)
) ENGINE = InnoDB;


CREATE TABLE `Address` (
    `CV_id` INT NOT NULL,
    `home` VARCHAR(255) NOT NULL,
    `country` VARCHAR(75) NOT NULL DEFAULT '',
    `state` VARCHAR(75) NOT NULL DEFAULT '',
    `city` VARCHAR(75) NOT NULL DEFAULT '',
    PRIMARY KEY (`CV_id`, `home`, `country`, `state`, `city`)
) ENGINE = InnoDB;

-- Insert data

INSERT INTO `CV` (title, name, job, email, introduction, other, ref_email, ref_Phone, color, password, access_level, owner, create_time) 
VALUES
('Untitled', 'Johnny Someone', 'Senior Enginner', 'f@gmail.com', 'Pref', 'Something overhere', 'abc@example.com', '012312415151', '#000', "", 1, "1", '2024-11-21 15:52:03'),
('Untitled2', 'Wi To Low', 'Airplane Pilot', 'example@gmail.com', 'Don''t care', 'Nothing overhere', 'cdf@example.com', '012312415151', '#283618', '123', 3, "1", '2024-11-21 16:39:24'),
('Senior Form', 'Saxxy Award', 'Award Trader', 'pass@gmail.com', 'I don''t', 'I don''t work for free', 'supporter@gmail.com', '+23 (130) 222 0000', '#774936', '123456', 3, "1", '2024-11-21 20:53:33');

INSERT INTO Allow (user_id, CV_id) 
VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 3);

INSERT INTO Phone (CV_id, number) 
VALUES
(1, '12136229124'),
(1, '91531613121'),
(2, '12136229124'),
(3, '+11 222 3333 444');

INSERT INTO Experience (CV_id, job, company, employer, description, start_year, end_year) 
VALUES
(1, 'Junior Engineer', 'Elec comp Inc.', 'Mr.B', 'Fix electric. Invent new idea', '2005', '2005'),
(1, 'Senior Engineer', 'Thunder Inc.', 'Mr.A', 'Invent new idea. Do something', '2009', '2010'),
(2, 'Teacher', 'Uni of Teaching', 'Principal A', 'Create new teaching model. Teaching students', '2009', '2010'),
(2, 'Translator', 'White House', 'Obama', 'Translate for president', '2005', '2009'),
(3, 'Researcher', 'Bureau of Science and Engineering', 'County O. Viena', 'Research stuff. Create new thing', '2012', '2014'),
(3, 'Senior Electrical Engineer', 'EVN VietNam', 'Boss D. Luffy', 'Do power grid. Did something', '2008', '2010');

INSERT INTO Education (CV_id, university, major, degree, gpa, start_year, end_year) 
VALUES
(1, 'Harvard', 'Light Electricity', 'Phd of Electricity', '3.2', '2000', '2004'),
(1, 'Harvard', 'Water', 'Phd of  Water Engieering', '3.2', '2000', '2004'),
(2, 'Oxford', 'English', 'Phd of Proficiency', '4.0', '2000', '2004'),
(2, 'Oxford', 'Japanese', 'Phd of Fluency', '4.0', '2000', '2004'),
(3, 'Uni of Science and Technology', 'Chemistry', 'Bachelor of Heavy. Phd of Soft', '3.1', '2004', '2008'),
(3, 'Uni of Science and Technology', 'Electricity ', 'Bachelor and Phd', '2', '2000', '2004');

INSERT INTO Address (CV_id, home, country, state, city) 
VALUES
(1, '1111 Blue Street', '2077456', '2061327', '-33.66078,136.28893'),
(1, 'Beta 231 Green Street', '2077456', '2061327', '-33.66078,136.28893'),
(2, 'Beta 231 Green Street', '2077456', '2061327', '-33.66078,136.28893'),
(3, '123 GreenWood Street', '2077456', '2061327', '-33.66078,136.28893'),
(3, '333 Blue Street', '2077456', '2061327', '-33.66078,136.28893');

INSERT INTO Skill (CV_id, name, year) 
VALUES
(1, 'Electrical Engineer', 2),
(1, 'Engineer', 1),
(2, 'Gamer', 2),
(2, 'Super Engineer', 1),
(3, 'Bicycle', 2),
(3, 'High Jump', 3);
