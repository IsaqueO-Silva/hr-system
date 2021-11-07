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
	
END $$
DELIMITER ;