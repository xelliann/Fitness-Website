<?php
include 'partials/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the diet plan
$sql = "SELECT * FROM diet_plan WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dietPlan = [];
while ($row = $result->fetch_assoc()) {
    $day = ucfirst($row['day']);
    $dietPlan[$day][$row['meal_type']] = [
        'name' => $row['meal_name'],
        'calories' => $row['calories']
    ];
}

$stmt->close();
$conn->close();
?>


<div class="h1">
    Your Diet Plan
</div>

<div class="d1">
    <?php foreach ($dietPlan as $day => $meals): ?>
        <div class="card">
            <div class="header1">
                <?php echo $day; ?>
            </div>
            <div class="data">
                <ul>
                    <?php foreach ($meals as $mealType => $meal): ?>
                        <li><span><?php echo ucfirst($mealType); ?>: </span><?php echo $meal['name']; ?> (<?php echo $meal['calories']; ?> kcal)</li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<?php
include 'partials/footer.php';
?>
</body>
</html>
