<?php

    // function to get or create entries in the db

    function get_assignments_by_course($course_id){

        global $db;

        if($course_id) {
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY A.ID';
        } else {
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID ORDER BY C.courseID';
        }

        $statement = $db->prepare($query);
        $statement->bindValue(':course_id',$course_id);
        $statement->execute();

        $assignments = $statement->fetchAll();
        $statement->closeCursor();

        return $assignments;

    }


    // delete function to remove entries in the database
    function delete_assignment($assignment_id){

        global $db;

        $query = 'DELETE FROM assignments WHERE ID = :assign_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':assign_id',$assignment_id);
        $statement->execute();

        $statement->closeCursor();

    }


    // add assignment to list function

    function add_assignment($course_id, $description){

        global $db;

        $query = 'INSERT INTO assignments (Description, courseID) VALUES (:descr, :courseID)';

        $statement = $db->prepare($query);
        $statement->bindValue(':descr', $description);
        $statement->bindValue('courseID', $course_id);
        $statement->execute();

        $statement->closeCursor();

    }


?>