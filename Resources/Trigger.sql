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
    '$2a$12$1/pf2clpfcQxezv/Xw9gG.ITsGKwgewz4JFsflooHDyRy8qdzEJKy',
    '1','DEFAULT');
END

//create_students_account (BEFORE INSERT ON)
BEGIN   
    INSERT INTO users(id, NISN, PASSWORD, role, 
    profile_picture) VALUES (uuid(), NEW.NISN,
    '$2a$12$1/pf2clpfcQxezv/Xw9gG.ITsGKwgewz4JFsflooHDyRy8qdzEJKy',
    '2','DEFAULT');
END

//set_completeness_id_in_subjects (BEFORE INSERT ON)
BEGIN 
    SET NEW.completness_id = (SELECT id FROM completeness
    WHERE completeness.score = NEW.completeness_id);
END

//insert_students(after update)
BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), NEW.name, NEW.place_of_birth, NEW.date_of_birth, NEW.address, NEW.phone_numbers, 'u');
    END


//update_students
BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, NEW.name, OLD.place_of_birth, IF(NEW.place_of_birth IN (OLD.place_of_birth), '-', NEW.place_of_birth), OLD.date_of_birth, 
NEW.date_of_birth, OLD.address, IF(NEW.address IN (OLD.address), '-', NEW.address), OLD.phone_numbers, NEW.phone_numbers, 'u');
    END


//delete_students( before delete)
BEGIN
    INSERT INTO log_students(id, old_name, new_name, old_place_of_birth, new_place_of_birth, old_date_of_birth, new_date_of_birth, old_address, new_address, old_phone_numbers, new_phone_numbers, type)
    VALUES(uuid(), OLD.name, OLD.place_of_birth, OLD.date_of_birth, OLD.address, OLD.phone_numbers, 'u');
    END