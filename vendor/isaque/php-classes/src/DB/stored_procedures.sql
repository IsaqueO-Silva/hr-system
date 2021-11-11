DELIMITER $$

CREATE PROCEDURE sp_jobs_save(
pjob_id INT(11),
pjob_title VARCHAR(100),
pmin_salary DECIMAL(15,2),
pmax_salary DECIMAL(15,2)
)
BEGIN

	IF pjob_id > 0  THEN

    UPDATE jobs
    SET
      job_title 	= pjob_title,
      min_salary 	= pmin_salary,
      max_salary 	= pmax_salary
    WHERE (job_id 	= pjob_id);

  ELSE

    INSERT INTO jobs(job_title, min_salary, max_salary)
    VALUES (pjob_title, pmin_salary, pmax_salary);

    SET pjob_id = LAST_INSERT_ID();

  END IF;
  
  SELECT *
  FROM jobs
  WHERE (job_id = pjob_id);
	
END

CREATE PROCEDURE sp_regions_save(
pregion_id INT(11),
pregion_name VARCHAR(100)
)
BEGIN

	IF pregion_id > 0  THEN

    UPDATE regions
    SET
      region_name = pregion_name
    WHERE (region_id    = pregion_id);

  ELSE

    INSERT INTO regions(region_name)
    VALUES (pregion_name);

    SET pregion_id = LAST_INSERT_ID();

  END IF;
  
  SELECT *
  FROM regions
  WHERE (region_id = pregion_id);
	
END

CREATE PROCEDURE sp_countries_save(
pcountry_id INT(11),
pcountry_name VARCHAR(100),
pregion_id INT(11)
)
BEGIN

	IF pcountry_id > 0  THEN

    UPDATE countries
    SET
      country_name  = pcountry_name,
      region_id     = pregion_id
    WHERE (country_id    = pcountry_id);

  ELSE

		INSERT INTO countries(country_name, region_id)
    VALUES (pcountry_name, pregion_id);

		SET pcountry_id = LAST_INSERT_ID();

  END IF;
    
  SELECT *
  FROM countries
  WHERE (country_id = pcountry_id);
	
END

CREATE PROCEDURE sp_locations_save(
plocation_id INT(11),
pstreet_address VARCHAR(200),
ppostal_code VARCHAR(10),
pcity VARCHAR(100),
pstate_province VARCHAR(100),
pcountry_id INT(11)
)
BEGIN

	IF plocation_id > 0  THEN

    UPDATE locations
    SET
      street_address   = pstreet_address,
      postal_code      = ppostal_code,
      city             = pcity,
      state_province   = pstate_province,
      country_id       = pcountry_id
    WHERE (location_id    = plocation_id);

  ELSE

		INSERT INTO locations(street_address, postal_code, city, state_province, country_id)
    VALUES (pstreet_address, ppostal_code, pcity, pstate_province, pcountry_id);

		SET plocation_id = LAST_INSERT_ID();

  END IF;
    
  SELECT *
  FROM locations
  WHERE (location_id = plocation_id);
	
END

CREATE PROCEDURE sp_departments_save(
pdepartment_id INT(11),
pdepartment_name VARCHAR(200),
plocation_id INT(11)
)
BEGIN

	IF pdepartment_id > 0  THEN

    UPDATE departments
    SET
      department_name  = pdepartment_name,
      location_id      = plocation_id
    WHERE (department_id    = pdepartment_id);

  ELSE

		INSERT INTO departments(department_name, location_id)
    VALUES (pdepartment_name, plocation_id);

		SET pdepartment_id = LAST_INSERT_ID();

  END IF;
    
  SELECT *
  FROM departments
  WHERE (department_id = pdepartment_id);
	
END

CREATE PROCEDURE sp_employees_save(
pemployee_id INT(11),
pfist_name VARCHAR(100),
plast_name VARCHAR(100),
pemail VARCHAR(120),
pphone_number VARCHAR(15),
phire_date DATETIME,
pjob_id INT(11),
psalary DECIMAL(15, 2),
pdepartment_id INT(11),
plogin VARCHAR(64),
ppassword VARCHAR(256)
)
BEGIN

	IF pemployee_id > 0  THEN

    UPDATE employees
    SET
      fist_name = pfist_name,
      last_name = plast_name,
      email = pemail,
      phone_number = pphone_number,
      hire_date = phire_date,
      job_id = pjob_id,
      salary = psalary,
      department_id = pdepartment_id
    WHERE (employee_id    = pemployee_id);

    UPDATE users
    SET
      login = plogin
    WHERE (employee_id = pemployee_id);

  ELSE

		INSERT INTO employees(fist_name, last_name, email, phone_number, hire_date, job_id, salary, department_id)
    VALUES (pfist_name, plast_name, pemail, pphone_number, phire_date, pjob_id, psalary, pdepartment_id);

		SET pemployee_id = LAST_INSERT_ID();

    IF plogin != "" AND ppassword != "" THEN

      INSERT INTO users(employee_id, login, password)
      VALUES(pemployee_id, plogin, ppassword);
    END IF;

  END IF;

  SELECT *
  FROM employees
  WHERE (employee_id = pemployee_id);
	
END $$
DELIMITER ;