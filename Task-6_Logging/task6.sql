CREATE DATABASE logging_db;
USE logging_db;

CREATE TABLE employees(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50),
salary INT
);

CREATE TABLE employee_logs(
log_id INT AUTO_INCREMENT PRIMARY KEY,
emp_id INT,
action_type VARCHAR(20),
action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER log_employee_insert
AFTER INSERT ON employees
FOR EACH ROW
BEGIN
INSERT INTO employee_logs(emp_id,action_type)
VALUES(NEW.id,'INSERT');
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER log_employee_update
AFTER UPDATE ON employees
FOR EACH ROW
BEGIN
INSERT INTO employee_logs(emp_id,action_type)
VALUES(NEW.id,'UPDATE');
END$$

DELIMITER ;

CREATE VIEW daily_activity AS
SELECT DATE(action_time) AS activity_date,
COUNT(*) AS total_actions
FROM employee_logs
GROUP BY DATE(action_time);