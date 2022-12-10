CREATE VIEW male_students AS
SELECT students.NISN, students.name, students.gender
FROM students
WHERE gender='M';

CREATE VIEW female_students AS
SELECT students.NISN, students.name, students.gender
FROM students
WHERE gender='F';

