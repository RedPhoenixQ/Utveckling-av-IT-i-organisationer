CREATE DATABASE IF NOT EXISTS grupp3;

DELIMITER //
CREATE OR REPLACE PROCEDURE new_auth(ssn CHAR(12), pwd VARCHAR(100), name VARCHAR(140)) 
BEGIN
	SET @salt = HEX(RAND()*0xFFFFFFFF);
	SET @hash = MD5(CONCAT(pwd, @salt));
	INSERT INTO auth(ssn, pwd, salt, name) VALUES (ssn, @hash, @salt, name);
END//

CREATE OR REPLACE PROCEDURE verify_auth(ssn CHAR(12), pwd VARCHAR(100)) 
BEGIN
	SET @salt = (SELECT salt FROM auth WHERE auth.ssn = ssn);
	SET @hash = MD5(CONCAT(pwd, @salt)) COLLATE utf8mb4_unicode_ci;
	SELECT ssn, name FROM auth WHERE auth.ssn = ssn AND auth.pwd = @hash INTO @ssn, @name;
    IF @ssn IS NULL THEN
		SIGNAL SQLSTATE "53001"
			SET MESSAGE_TEXT = "Felaktigt lösenord eller personnummer";
	ELSE 
		SELECT @ssn as "ssn", @name as "name";
	END IF;
END//
DELIMITER ;

CREATE TABLE IF NOT EXISTS auth(
    ssn CHAR(12) NOT NULL,
    pwd CHAR(32) NOT NULL,
    salt CHAR(8) NOT NULL,
    name VARCHAR(140) NOT NULL,
    PRIMARY KEY (ssn)
);