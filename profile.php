<?php
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$goal = $_POST['goal'];

$query = "UPDATE users SET username='$name', age='$age', weight='$weight', height='$height', goal='$goal' WHERE id='$user_id'";
if (mysqli_query($conn, $query)) {
    header("Location: profile.php");
} else {
    echo "Update failed: " . mysqli_error($conn);
}
?>



<div class="container">

    <div class="bmi-calculator">
        <h2>Personal Information</h2>
        <form action="update_profile.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $user['username']; ?>" required>

            <label for="age">Age:</label>
            <input type="number" name="age" value="<?php echo $user['age']; ?>" required>

            <label for="weight">Weight:</label>
            <input type="number" name="weight" value="<?php echo $user['weight']; ?>" required>

            <label for="height">Height:</label>
            <input type="number" name="height" value="<?php echo $user['height']; ?>" required>

            <label for="goal">Goal:</label>
            <input type="text" name="goal" value="<?php echo $user['goal']; ?>" required>

            <button type="submit">Update Info</button>
        </form>
    </div>

    <div class="plans-section">
        <h2>My Plans</h2>
        <div class="plan">
            <h3>Diet Plan</h3>
            <?php
            // Fetch and display diet plan
            $diet_query = "SELECT * FROM diet_plan WHERE user_id = '$user_id'";
            $diet_result = mysqli_query($conn, $diet_query);
            if (mysqli_num_rows($diet_result) > 0) {
                $diet_plan = mysqli_fetch_assoc($diet_result);
                echo "<p>" . $diet_plan['plan_details'] . "</p>";
            } else {
                echo "<p>No diet plan available. <a href='create_diet_plan.php'>Create one</a></p>";
            }
            ?>
        </div>

        <div class="plan">
            <h3>Exercise Plan</h3>
            <?php
            // Fetch and display exercise plan
            $exercise_query = "SELECT * FROM exercise_plan WHERE user_id = '$user_id'";
            $exercise_result = mysqli_query($conn, $exercise_query);
            if (mysqli_num_rows($exercise_result) > 0) {
                $exercise_plan = mysqli_fetch_assoc($exercise_result);
                echo "<p>" . $exercise_plan['plan_details'] . "</p>";
            } else {
                echo "<p>No exercise plan available. <a href='create_exercise_plan.php'>Create one</a></p>";
            }
            ?>
        </div>
    </div>

    <div class="progress-section">
        <h2>Progress Tracker</h2>
        <!-- Add progress tracking here -->
        <p>Track your weight, milestones, and achievements.</p>
    </div>

    <div class="feedback-section">
        <h2>Feedback</h2>
        <form action="submit_feedback.php" method="POST">
            <textarea name="feedback" placeholder="Leave your feedback here..."></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</div>

</body>
</html>
