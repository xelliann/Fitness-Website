<?php
include 'partials/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: /auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT day, exercise_name, reps_or_duration FROM exercise_plan WHERE user_id = ? ORDER BY FIELD(day, 'monday','tuesday','wednesday','thursday','friday','saturday','sunday')";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$exercise_plan = [];
while ($row = $result->fetch_assoc()) {
    $day = strtolower($row['day']);
    $exercise_plan[$day][] = [
        'name' => $row['exercise_name'],
        'info' => $row['reps_or_duration']
    ];
}

$stmt->close();
$conn->close();
?>
<div class="h1">
    Weekly Exercise Plan 
</div>

        <div class="d1">
            <?php
            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
            foreach ($days as $day):
                $exercises = $exercise_plan[$day] ?? [];
            ?>
            <div class="card">
                <div class="header1">
                    <?= ucfirst($day) ?>
                </div>
                <div class="data">  
                    <ul>
                        <?php if (count($exercises) > 0): ?>
                            <?php foreach ($exercises as $exercise): ?>
                                <li><strong><?= htmlspecialchars($exercise['name']) ?>:</strong> <?= htmlspecialchars($exercise['info']) ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No exercises planned.</li>
                        <?php endif; ?>
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
