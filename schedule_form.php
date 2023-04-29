<form method="post" action="add_class.php" name="class_form">
    <fieldset>
        <legend>Add a Class</legend>
        <p>
            <label for="class_name">Class Name: </label>
            <input type="text" name="class_name" id="class_name" required>
        </p>
        <p>
            <label for="day_of_week">Day of Week: </label>
            <select name="day_of_week" id="day_of_week">
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
            </select>
        </p>
        <p>
            <label for="start_time">Start Time: </label>
            <select name="start_time" id="start_time">
                <?php
                for ($i = 6 * 60; $i <= 22 * 60; $i += 15) {
                    $time = sprintf('%02d:%02d', intdiv($i, 60), $i % 60);
                    echo "<option value='$time'>$time</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="end_time">End Time: </label>
            <select name="end_time" id="end_time">
                <?php
                for ($i = 6 * 60 + 15; $i <= 22 * 60; $i += 15) {
                    $time = sprintf('%02d:%02d', intdiv($i, 60), $i % 60);
                    echo "<option value='$time'>$time</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Add Class">
        </p>
    </fieldset>
</form>