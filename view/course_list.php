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
                        <input type="hidden" name="course_id" value="<?= $course['courseID']?>">
                        <button class="remove-button">❌</button>
                    </form>
                </div>
            </div>

            <?php endforeach ?>
    </section>
            <!-- end of loop through courses -->
    <?php } else { ?>
        <p>No courses exist</p>
    <?php } ?>


    <!-- adding a course -->
    <section id="add" class="add">
        <h2>Add course</h2>
        <form action="." method="post" id="add__form" class="add__form">
            <input type="hidden" name="action" value="add__course">
            <div class="add__inputs">
                <label for="">Name:</label>
                <input type="text" name="course_name" maxlength="50" placeholder="Name" autofocus required>
            </div>

            <div class="add_addItem">
                <button class="add-button bold">Add</button>
            </div>
        </form>
    </section>
    <br>
    <p><a href=".">View &amp; Add Assignments</a></p>





<?php include('view/footer.php') ?>

