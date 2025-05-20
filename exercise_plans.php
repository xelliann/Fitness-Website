<?php
require 'partials/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}
$username = $_SESSION['username'] ?? null;

$user_id = $_SESSION['user_id'];

// Check if exercise plan exists
$stmt = $conn->prepare("SELECT COUNT(*) FROM exercise_plan WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

      <div class="ex">
            <div class="ex1">
                Exercise Planner
            </div>
            <div class="exlist">
                <?php if ($count > 0): ?>
                   
                    <div class="ex11">
                        <a href="view_exercise_plan.php" class="btn">My Plan</a>
                    </div>
                    <div class="ex11">
                        <a href="create_exercise_form.php" class="btn secondary">Create New Plan</a>
                    </div>
                <?php else: ?>
                    <div class="ex11">
                        No exercise plan found.
                    </div>
                    <div class="ex11">
                        <a href="create_exercise_form.php" class="btn secondary">Create New Plan</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
        <?php include 'partials/footer.php'; ?>


