<?php
include 'partials/header.php'; 
$today = date('Y-m-d');

// Get today's stats
$statsQuery = $conn->prepare("SELECT * FROM daily_stats WHERE user_id = ? AND date = ?");
$statsQuery->bind_param("is", $user_id, $today);
$statsQuery->execute();
$statsResult = $statsQuery->get_result()->fetch_assoc();

// Get today's meals
$mealQuery = $conn->prepare("SELECT * FROM meals WHERE user_id = ? AND date = ?");
$mealQuery->bind_param("is", $user_id, $today);
$mealQuery->execute();
$mealsResult = $mealQuery->get_result();

// Get recommended food
$recQuery = $conn->query("SELECT * FROM recommended_food LIMIT 3");
$recommendedFoods = $recQuery ? $recQuery->fetch_all(MYSQLI_ASSOC) : [];

$calorieChartQuery = $conn->prepare("SELECT date, calories_burned FROM user_fitness_data WHERE user_id = ? ORDER BY date DESC LIMIT 10");
$calorieChartQuery->bind_param("i", $user_id);
$calorieChartQuery->execute();
$chartResult = $calorieChartQuery->get_result();
$chartData = [];

while ($row = $chartResult->fetch_assoc()) {
    $chartData[] = [
        'date' => date('M d', strtotime($row['date'])),
        'calories' => (int)$row['calories_burned']
    ];
}

$chartData = array_reverse($chartData);
$chartLabels = array_column($chartData, 'date');
$chartCalories = array_column($chartData, 'calories');
?>

    <!-- Dashboard -->
    <section class="dashboard">
      <h2>Welcome back <?= htmlspecialchars($username ?? '') ?></h2>
      
      <div class="tracker-cards">
        <div class="card1">
        <div><span class="material-symbols-outlined">local_fire_department</span> </div>
        <div><p>Calories (kcal)</p><h2><?= $statsResult['calories'] ?? '0' ?> cal</h2></div>
        </div>
        <div class="card2">
          <div><span class="material-symbols-outlined">cookie</span></div>
          <div><p>Carbs Tracker</p><h2><?= $statsResult['carbs'] ?? '0' ?> g</h2></div>
        </div>
        <div class="card3">
          <div><span class="material-symbols-outlined">favorite</span></div>
          <div><p>Heart Tracker</p><h2><?= $statsResult['heart_rate'] ?? '0' ?> bpm</h2></div>
          
        </div>
        <div class="card4">
          <div><span class="material-symbols-outlined">timer_10_alt_1</span></div>
          <div> <p>Exercise Tracker</p><h2><?= $statsResult['exercise_minutes'] ?? '0' ?> min</h2></div>
         
        </div>
      </div>

      <div class="ca1">
        <h3>Calories Graph</h3>
        <canvas id="caloriesChart" height="100"></canvas>
      </div>

      <div class="ca1">
        <h3>Meal for today</h3>
        <table class="meal-table">
          <thead>
            <tr>
              <th>Time</th>
              <th>Name</th>
              <th>Category</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $mealsResult->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['time']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['amount']) ?> item(s)</td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>

      <div class="ca1">
        <h3>Recommend food</h3>
        <ul class="rec-foods">
          <?php foreach ($recommendedFoods as $food): ?>
            <li>
              <strong><?= htmlspecialchars($food['icon']) ?> <?= htmlspecialchars($food['food_name']) ?></strong><br>
              <span><?= htmlspecialchars($food['carbs']) ?>g Carbs, <?= htmlspecialchars($food['fats']) ?>g Fats (<?= htmlspecialchars($food['quantity']) ?>)</span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </section>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('caloriesChart').getContext('2d');
const chart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($chartLabels) ?>,
    datasets: [{
      label: 'Calories',
      data: <?= json_encode($chartCalories) ?>,
      borderColor: '#9b5de5',
      backgroundColor: 'rgba(155,93,229,0.1)',
      fill: true,
      tension: 0.4,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
<?php include 'partials/footer.php';?>
</body>
</html>
