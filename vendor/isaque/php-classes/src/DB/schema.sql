#CREATE DATABASE  IF NOT EXISTS `db_hr`;
#USE `db_hr`;

DROP TABLE IF EXISTS `db_hr`.`regions`;

CREATE TABLE regions (
	region_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    region_name VARCHAR(100) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS `db_hr`.`countries`;

CREATE TABLE countries (
    country_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    country_name VARCHAR(100) NOT NULL UNIQUE,
    region_id INTEGER NOT NULL,
    FOREIGN KEY(region_id) REFERENCES regions(region_id)
);

DROP TABLE IF EXISTS `db_hr`.`locations`;

CREATE TABLE locations (
	location_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    street_address VARCHAR(200) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state_province VARCHAR(100) NOT NULL,
    country_id INTEGER NOT NULL,
    FOREIGN KEY(country_id) REFERENCES countries(country_id)
);

DROP TABLE IF EXISTS `db_hr`.`departaments`;

CREATE TABLE departaments (
	departament_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    departament_name VARCHAR(200) NOT NULL UNIQUE,
    location_id INTEGER NOT NULL,
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
);

DROP TABLE IF EXISTS `db_hr`.`jobs`;

CREATE TABLE jobs (
	job_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    job_title VARCHAR(100) NOT NULL,
    min_salary DECIMAL(15,2) NOT NULL,
    max_salary DECIMAL(15,2) NOT NULL
);

DROP TABLE IF EXISTS `db_hr`.`employees`;

CREATE TABLE employees (
	employee_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fist_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    hire_date DATETIME NOT NULL,
    job_id INTEGER NOT NULL,
    salary DECIMAL(15,2) NOT NULL,
    departament_id INTEGER NOT NULL,
	FOREIGN KEY(job_id) REFERENCES jobs(job_id),
    FOREIGN KEY(departament_id) REFERENCES departaments(departament_id)
);