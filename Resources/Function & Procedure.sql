//FUNCTION
//assignRole
BEGIN
DECLARE result VARCHAR(255);
IF role = '0' THEN
SET result = 'Admin';
ELSEIF role = '1' THEN
SET result = 'Guru';
ELSE
SET result = 'Siswa';
END IF;
RETURN result;
END

//PROCEDURES
//getFemaleStudents
BEGIN
SELECT homeroom_class_id, NISN, name, gender FROM students
WHERE gender = 'F';
END

//getMaleStudents
BEGIN
SELECT homeroom_class_id, NISN, name, gender
FROM students
WHERE gender = 'M';
END

//seventhGrade
BEGIN
SELECT  * FROM classes
WHERE name LIKE '7%';
END

//eighthGrade
BEGIN
SELECT  * FROM classes
WHERE name LIKE '8%';
END

//ninthGrade
BEGIN
SELECT  * FROM classes
WHERE name LIKE '9%';
END
