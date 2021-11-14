CREATE DATABASE  IF NOT EXISTS 'db_hr';
USE 'db_hr';

DROP TABLE IF EXISTS 'db_hr'.'regions';

CREATE TABLE regions (
	region_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    region_name VARCHAR(100) NOT NULL UNIQUE
);

DROP TABLE IF EXISTS 'db_hr'.'countries';

CREATE TABLE countries (
    country_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    country_name VARCHAR(100) NOT NULL UNIQUE,
    region_id INTEGER NOT NULL,
    FOREIGN KEY(region_id) REFERENCES regions(region_id)
);

DROP TABLE IF EXISTS 'db_hr'.'locations';

CREATE TABLE locations (
	location_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    street_address VARCHAR(200) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state_province VARCHAR(100) NOT NULL,
    country_id INTEGER NOT NULL,
    FOREIGN KEY(country_id) REFERENCES countries(country_id)
);

DROP TABLE IF EXISTS 'db_hr'.'departments';

CREATE TABLE departments (
	department_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(200) NOT NULL UNIQUE,
    location_id INTEGER NOT NULL,
    FOREIGN KEY(location_id) REFERENCES locations(location_id)
);

DROP TABLE IF EXISTS 'db_hr'.'jobs';

CREATE TABLE jobs (
	job_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    job_title VARCHAR(100) NOT NULL,
    min_salary DECIMAL(15,2) NOT NULL,
    max_salary DECIMAL(15,2) NOT NULL
);

DROP TABLE IF EXISTS 'db_hr'.'employees';

CREATE TABLE employees (
	employee_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fist_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    hire_date DATETIME NOT NULL,
    job_id INTEGER NOT NULL,
    salary DECIMAL(15,2) NOT NULL,
    department_id INTEGER NOT NULL,
	FOREIGN KEY(job_id) REFERENCES jobs(job_id),
    FOREIGN KEY(department_id) REFERENCES departments(department_id)
);

DROP TABLE IF EXISTS 'db_hr'.'users';

CREATE TABLE users (
  user_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  employee_id INTEGER,
  login VARCHAR(64) NOT NULL,
  password VARCHAR(256) NOT NULL,
  dtregister TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(employee_id) REFERENCES employees(employee_id)
);

DROP TABLE IF EXISTS 'db_hr'.'users_passwords_recoveries';

CREATE TABLE users_passwords_recoveries (
    recovery_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    user_ip VARCHAR(45) NOT NULL,
    recovery_date DATETIME,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);