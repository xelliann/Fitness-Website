<?php
include 'partials/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location:/auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM diet_plan WHERE user_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $diet_plan_exists = false;
} else {
    $diet_plan_exists = true;
}

if ($diet_plan_exists) {
    $dietPlan = [];
    while ($row = $result->fetch_assoc()) {
        $day = ucfirst($row['day']);
        $dietPlan[$day][$row['meal_type']] = [
            'name' => $row['meal_name'],
            'calories' => $row['calories']
        ];
    }
}

$stmt->close();
$conn->close();

?>

<div class="ex">
        <div class="ex1">
            Diet Planner
        </div>
    <div class="exlist">
        <?php if (!$diet_plan_exists): ?>
            <div class="ex11">
                No diet plan found.
            </div> 
            <div class="ex11">
                <a href="create_diet_form.php" class="btn btn-primary">Create New Plan</a>
                
            </div>
        <?php else: ?>
            <div class="ex11">
            <a href="view_diet_plan.php" class="btn btn-secondary">My Plan</a>
            </div>
            <div class="ex11">
                <a href="create_diet_form.php" class="btn btn-primary">Create New Plan</a>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
<?php include 'partials/footer.php'; ?>

</body>
</html>
