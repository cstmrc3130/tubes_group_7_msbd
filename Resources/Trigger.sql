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

//create_teacher_account (BEFORE INSERT ON)
BEGIN   
    INSERT INTO users(id, NIP, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NIP,
    '$2a$12$HXA488uKmhQmJJa3zQKxC.J41vmu8g.PSKovhfEIqICc4DexC.CB.',
    '1','DEFAULT');
END

//create_students_account (BEFORE INSERT ON)
BEGIN   
    INSERT INTO users(id, NISN, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NISN,
    '$2a$12$HXA488uKmhQmJJa3zQKxC.J41vmu8g.PSKovhfEIqICc4DexC.CB.',
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

// STUDENTS
//update_log_students ( before update )
CREATE TRIGGER `update_log_students` BEFORE UPDATE ON `students`
 FOR EACH ROW BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, NEW.name, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, 'u');
    END

//delete_log_students ( BEFORE DELETE )
CREATE TRIGGER `delete_log_students` BEFORE DELETE ON `students`
 FOR EACH ROW BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, OLD.place_of_birth, OLD.date_of_birth, OLD.address, OLD.phone_numbers, 'd');
    END
 
//insert_log_students ( AFTER UPDATE)
CREATE TRIGGER `insert_log_students` AFTER INSERT ON `students`
 FOR EACH ROW BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), NEW.name, NEW.place_of_birth, NEW.date_of_birth, NEW.address, NEW.phone_numbers, 'i');
    END


// TRIGGER TEACHERS
//delete_log_teachers( Before delete )
CREATE TRIGGER `delete_log_teachers` BEFORE DELETE ON `teachers`
 FOR EACH ROW BEGIN
    INSERT INTO log_teachers(id, old_name, new_name, old_position, new_position, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, OLD.position, OLD.place_of_birth,   	 OLD.date_of_birth, OLD.address, OLD.phone_numbers, 'd');
    END

//insert_log_teachers( After Update )
CREATE TRIGGER `insert_log_teachers` AFTER UPDATE ON `teachers`
 FOR EACH ROW BEGIN
    INSERT INTO log_teachers(id, old_name, new_name, old_position, new_position, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), NEW.name, NEW.position, NEW.place_of_birth,  
    NEW.date_of_birth, NEW.address, NEW.phone_numbers, 'i');
    END

//update_log_teachers ( Before Update )
CREATE TRIGGER `update_log_teachers` BEFORE UPDATE ON `teachers`
 FOR EACH ROW BEGIN
    INSERT INTO log_teachers(id, old_name, new_name, old_position, new_position, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, NEW.name, OLD.position, NEW.position, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, 'u');
    END


///USERS 
//DELETE_LOG_USERS 
CREATE TRIGGER `delete_log_users` BEFORE DELETE ON `users`
 FOR EACH ROW BEGIN	
	INSERT INTO log_users ( id, old_email, new_email, 	     
                           old_password, new_password, 
                           old_profile_picture, 
                           new_profile_picture, type)
                   VALUES  (uuid(), OLD.email, 
                            OLD.password, 
                            OLD.profile_picture, 'd');
                   END


//INSERT_LOG_USERS
CREATE TRIGGER `insert_log_users` AFTER UPDATE ON `users`
 FOR EACH ROW BEGIN	
	INSERT INTO log_users ( id, old_email, new_email, 	     
                           old_password, new_password, 
                           old_profile_picture, 
                           new_profile_picture, type)
                   VALUES  (uuid(), NEW.email, 
                            NEW.password, 
                            NEW.profile_picture, 'i');
                   END


///UPDATE_LOG_USERS
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

///CLASSES 
//DELETE_LOG_CLASSES (MESSAGE)
CREATE TRIGGER `delete_log_classes` BEFORE DELETE ON `classes`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'You Cant Delete This Class';
END

//UPDATE_LOG_CLASSES 
CREATE TRIGGER `update_log_classes` BEFORE UPDATE ON `classes`
 FOR EACH ROW BEGIN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'YOU CANT CHANGE CONTAIN IN THIS CLASS';
END


//SUBJECTS 
//UPDATE_LOG_SUBJECTS
BEGIN 
	INSERT INTO log_subjects (id, old_name, new_name, 		
                              old_completeness, new_completeness 
                              )
                      VALUES  (uuid(), OLD.name, NEW.name, 
                               OLD.completeness, 
                               NEW.completeness
                               );
                        	   END

