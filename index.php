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

