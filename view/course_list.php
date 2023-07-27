<!-- list all courses and be able to add a course -->


<?php include('view/header.php') ?>


<?php if ($courses) { ?>

    <section id="list" class="list">
        <header class="list__row list__header">
            <h1>Course List</h1>
        </header>


        <?php foreach($courses as $course) : ?>
            <div class="list__row"></div>
                <div class="list__item">
                    <p class="bold"><?= $course['courseName'] ?></p>
                </div>

                <div class="list_removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_course">
                        <input type="hidden" name="course_id" value="<?= $course['courseID']?>"
                    </form>
                </div>
    <?php } else { ?>
        <p>No courses exist</p>
    <?php } ?>







<?php include('view/footer.php') ?>

