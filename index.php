<!-- this file is the controller for the application -->
<!-- controller fully written in php -->

<?php 

    // import the necessary files 
    require('model/database.php');
    require('model/assignments_db.php');
    require('model/course_db.php');


    // What data will the controller receive

    $assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description_id = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
    $course_name = filter_input(INPUT_POST, 'course_name', FILTER_UNSAFE_RAW);

    // filter_sanitize_string is deprecated;  htmlspecialchars seems to be the normal way to sanitize input to avoid sql injection
    // $course_name = htmlspecialchars(INPUT_POST, 'course_name');
    // $description_id = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);


    $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
    if(!$course_id) {
        $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
    }

    // To help choose the different routes to take on the form

    $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
    if(!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
        if(!$action){
            $action = 'list_assignments';
        }
    }


    // switch statement to handle routing; send specific data to the view
    // calling from the methods in the imported models we required at the start

    switch($action) {

        // adding routes
        case "list_courses":
            $courses = get_courses();
            include('view/course_list.php');
            break;

        case "add_course":
            add_course($course_name);
            header("Location: .?action=list_courses");
            break;

        case "add_assignment":
            if($course_id && $description) {
                add_assignment($course_id, $description);
                header("Location: .?course_id=$course_id");
            } else {
                $error = "Invalid assignment data. Check all fields and retry";
                include('view/error.php');
                exit;
            }
            break;

        case "delete_course":
            if($course_id) {
                try  {
                    delete_course($course_id);
                } catch (PDOException $e) {
                    $error = "Cannot delete course if assignments exist";
                    include('view/error.php');
                    exit;
                }
                header("Location: .?action=list_courses");

            }
            break;


        case "delete_assignment":
            if($assignment_id) {
                delete_assignment($assignment_id);
                header("Location: .?course_id=$course_id");
            } else {
                $error = "Missing/invalid assignment ID";
                include('view/error.php');
            }
            break;

        default: 
        $course_name = get_course_name($course_id);    
        $courses = get_courses();
        $assignments = get_assignments_by_course($course_id);

        include('view/assignment_list.php');
        
    }
