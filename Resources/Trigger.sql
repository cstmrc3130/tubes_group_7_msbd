//set_uuid_in_absent_recapitulations (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_classes (BEFORE INSERT ON )
BEGIN
    SET NEW.id = uuid();
END


//set_uuid_in_extracurriculars (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_extracurricular_scores (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_news (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_notifications (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_school_years (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END


//set_uuid_in_scoring_sessions (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_subjects (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_subjects_scores (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_taking_extracurriculars (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_teaching_extracurriculars (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_teaching_subjects (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//set_uuid_in_users (BEFORE INSERT)
BEGIN
    SET NEW.id = uuid();
END

//create_teacher_account (AFTER INSERT ON)
BEGIN   
    INSERT INTO users(id, NIP, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NIP,
    '$2a$12$VWXz3srRlDD2DQ5zLw9ZKezwVgXwInQicrMnbrjcSn9aY0WNJDBMe',
    '1','DEFAULT');
END

//create_students_account (AFTER INSERT ON)
BEGIN   
    INSERT INTO users(id, NISN, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NISN,
    '$2a$12$VWXz3srRlDD2DQ5zLw9ZKezwVgXwInQicrMnbrjcSn9aY0WNJDBMe',
    '2','DEFAULT');
END

//set_completeness_id_in_subjects (BEFORE INSERT ON)
BEGIN 
    SET NEW.completness_id = (SELECT id FROM completeness
    WHERE completeness.score = NEW.completeness_id);
END


////////////////////////////////////////////////
////////////// TRIGGER ////////////////////////
//////////////////////////////////////////////

// STUDENTS //
CREATE TRIGGER `insert_log_students` AFTER INSERT ON `students`
 FOR EACH ROW BEGIN
    INSERT INTO log_students(id, new_name, new_place_of_birth, new_date_of_birth, new_address, new_phone_numbers, type)
    VALUES(uuid(), NEW.name, NEW.place_of_birth, NEW.date_of_birth, NEW.address, NEW.phone_numbers, 'i');
    END

CREATE TRIGGER `update_log_students` BEFORE UPDATE ON `students`
 FOR EACH ROW BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, NEW.name, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, 'u');
    END



//  TEACHERS //
CREATE TRIGGER `create_new_account_teachers` AFTER INSERT ON `teachers`
 FOR EACH ROW BEGIN   
    INSERT INTO users(id, NIP, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NIP,
    '$2a$12$HXA488uKmhQmJJa3zQKxC.J41vmu8g.PSKovhfEIqICc4DexC.CB.',
    '1','DEFAULT');
END

CREATE TRIGGER `insert_log_teachers` AFTER INSERT ON `teachers`
 FOR EACH ROW BEGIN
    INSERT INTO log_teachers(id, new_name, new_position, new_place_of_birth, new_date_of_birth, new_address, new_phone_numbers, type)
    VALUES(uuid(), NEW.name, NEW.position, NEW.place_of_birth,  
    NEW.date_of_birth, NEW.address, NEW.phone_numbers, 'i');
    END

CREATE TRIGGER `update_log_teachers` BEFORE UPDATE ON `teachers`
 FOR EACH ROW BEGIN
    INSERT INTO log_teachers(id, old_name, new_name, old_position, new_position, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, NEW.name, OLD.position, NEW.position, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, 'u');
    END


/// USERS /// 
CREATE TRIGGER `insert_log_users` BEFORE INSERT ON `users`
 FOR EACH ROW BEGIN	
	INSERT INTO log_users ( id, new_email, 	     
                            new_password, new_profile_picture, type)
                   VALUES  (uuid(), NEW.email, 
                            NEW.password, 
                            NEW.profile_picture, 'i');
                   END

CREATE TRIGGER `update_log_users` BEFORE UPDATE ON `users`
 FOR EACH ROW BEGIN	
	INSERT INTO log_users ( id, old_email, new_email, 	     
                           old_password, new_password, 
                           old_profile_picture, 
                           new_profile_picture, type)
                   VALUES  (uuid(), OLD.email, NEW.email, 
                            OLD.password, NEW.password, 
                            OLD.profile_picture, 
                            NEW.profile_picture, 'u');
                   END

CREATE TRIGGER `delete_log_users` BEFORE DELETE ON `users`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "YOU CAN'T DELETE IT";
END



/// CLASSES // 
CREATE TRIGGER `insert_log_classes` AFTER UPDATE ON `classes`
 FOR EACH ROW BEGIN 
	INSERT INTO log_classes (id, new_name, new_semester)
   					 VALUES (uuid(), NEW.name, NEW.semester);
    END

CREATE TRIGGER `update_log_classes` BEFORE UPDATE ON `classes`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "YOU CAN'T CHANGE CONTAIN IN THIS CLASS";
END

CREATE TRIGGER `delete_classes` BEFORE DELETE ON `classes`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "YOU CAN'T DELETE THIS CLASS";
END



/// SUBJECTS ///
CREATE TRIGGER `delete_log_subjects` BEFORE DELETE ON `subjects`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "YOU CAN'T DELETE IT!";
END

CREATE TRIGGER `insert_log_subjects` AFTER INSERT ON `subjects`
 FOR EACH ROW BEGIN 
	INSERT INTO log_subjects (id, new_name, 		
                              new_completeness 
                              )
                      VALUES  (uuid(), NEW.name, 
                               NEW.completeness
                               );
                        	   END

CREATE TRIGGER `update_log_subjects` BEFORE UPDATE ON `subjects`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "YOU CAN'T CHANGE IT!";
END




///  SCHOOL_YEAR  // 
CREATE TRIGGER `delete_log_school_year` BEFORE DELETE ON `school_years`
 FOR EACH ROW BEGIN
	SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "You Cant Delete it!!";
    END

CREATE TRIGGER `insert_log_school_year` BEFORE INSERT ON `school_years`
 FOR EACH ROW BEGIN	
	INSERT INTO log_school_years (
        id, new_year)
        VALUES (uuid(), NEW.year);
        END

CREATE TRIGGER `update_log_school_year` BEFORE UPDATE ON `school_years`
 FOR EACH ROW BEGIN
	SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "You Cant Change it!";
    END