<?php

    function get_courses() {
        global $db;


        $query = 'SELECT * FROM courses ORDER BY courseID';

        // borrowed code from other file assignments_db

        $statement = $db->prepare($query);
        $statement->execute();

        $courses = $statement->fetchAll();
        $statement->closeCursor();

        return $courses;
        
    }

    function get_course_name($course_id) {

        // check if there are courses
        if(!$course_id) {
            return "All courses!";
        }

        global $db;

        $query = 'SELECT * FROM courses WHERE courseID = :course_id';

        // borrowed code from other file assignments_db

        $statement = $db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();

        // just a single fetch as we are only fetching one course name

        $course = $statement->fetch();
        $statement->closeCursor();

        $course_name = $course['course_name'];


        return $course_name;


    }


    function delete_course($course_id){

        global $db;


        // Not returning any value

        $query = 'DELETE FROM courses WHERE courseID = :course_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();

        $statement->closeCursor();

    }



    function add_course($course_name) {

        global $db;


        // Not returning any value

        $query = 'INSERT INTO courses (courseName) VALUES (:courseName)';

        $statement = $db->prepare($query);
        $statement->bindValue(':courseName',$course_name);
        $statement->execute();

        $statement->closeCursor();


    }


?>
