<!-- this file is the controller for the application -->

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


    // switch statement to handle routing; send s pecific data tothe view
    // calling from the methods in the imported models we required at the start

    switch($action) {
        default: 
        $course_name = get_course_name($course_id);    
        $courses = get_courses();
        $assignments = get_assignments_by_course($course_id);

        include('view/assignment_list.php');
        
    }
