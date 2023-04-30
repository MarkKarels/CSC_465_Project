<span id="error_message" style="color: red;">
    <?php
    if (isset($_SESSION['error_message'])) {
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']);
    }
    ?>
</span>
<form method="post" action="add_class.php" name="class_form">
    <fieldset>
        <legend>Add a Class</legend>
        <p>
            <label for="class_name">Class Name: </label>
            <input type="text" name="class_name" id="class_name" required
                value="<?php echo isset($_SESSION['submitted_values']['class_name']) ? htmlspecialchars($_SESSION['submitted_values']['class_name']) : ''; ?>">
        </p>
        <p>
            <label for="day_of_week">Day of Week: </label>
            <select name="day_of_week" id="day_of_week">
                <option value="">-- Select a day --</option>
                <?php
                $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                for ($i = 0; $i < count($days); $i++) {
                    $selected = isset($_SESSION['submitted_values']['day_of_week']) && $_SESSION['submitted_values']['day_of_week'] == $i ? 'selected' : '';
                    echo "<option value='$i' $selected>$days[$i]</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="start_time">Start Time: </label>
            <select name="start_time" id="start_time">
                <option value="">-- Select Start Time --</option>
                <?php
                for ($i = 6 * 60; $i <= 22 * 60; $i += 15) {
                    $time = sprintf('%02d:%02d', intdiv($i, 60), $i % 60);
                    $selected = isset($_SESSION['submitted_values']['start_time']) && $_SESSION['submitted_values']['start_time'] == $time ? 'selected' : '';
                    echo "<option value='$time' $selected>$time</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="end_time">End Time: </label>
            <select name="end_time" id="end_time">
                <option value="">-- Select End Time --</option>
                <?php
                for ($i = 6 * 60 + 15; $i <= 22 * 60; $i += 15) {
                    $time = sprintf('%02d:%02d', intdiv($i, 60), $i % 60);
                    $selected = isset($_SESSION['submitted_values']['end_time']) && $_SESSION['submitted_values']['end_time'] == $time ? 'selected' : '';
                    echo "<option value='$time' $selected>$time</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Add Class">
        </p>
    </fieldset>
</form>