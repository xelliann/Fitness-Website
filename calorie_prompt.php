<?php
include 'partials/header.php';
loadEnv(__DIR__ . '/includes/.env');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foodInput = trim($_POST['food_input']);

    if (empty($foodInput)) {
        echo "<p style='color:red;'>Please enter some food details.</p>";
        exit();
    }

    $prompt = "You are a certified nutritionist. Provide a calorie breakdown for the following food items:\n" .
              $foodInput .
              "\nRespond ONLY as a valid JSON array like:\n" .
              "[{\"item\": \"Boiled Egg\", \"calories\": 78}, {\"item\": \"Toast\", \"calories\": 120}]\n" .
              "IMPORTANT: Ensure calorie values are full numbers, not expressions like 95 * 2. Just calculate and provide the final number.";

    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful and accurate calorie calculator.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'temperature' => 0.6
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_ENV['OPENAI_API_KEY']
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);
    $rawContent = $response['choices'][0]['message']['content'] ?? '';
// Remove backticks if present
$cleanedJson = trim($rawContent);
if (str_starts_with($cleanedJson, '```')) {
    $cleanedJson = preg_replace('/^```(json)?|```$/m', '', $cleanedJson);
    $cleanedJson = trim($cleanedJson);
}

$calorieData = json_decode($cleanedJson, true);
    ?>

    <div class="exe1">
        <div class='result-box'>
            <h2>Calorie Breakdown</h2>
            <?php
            if (is_array($calorieData)) {
                $totalCalories = 0;
                echo "<ul>";
                foreach ($calorieData as $item) {
                    $itemName = htmlspecialchars($item['item']);
                    $itemCalories = (int) $item['calories'];
                    echo "<li><strong>$itemName</strong> - $itemCalories kcal</li>";
                    $totalCalories += $itemCalories;
                }
                echo "</ul>";
                echo "<div class='total'>Total Calories Intake: {$totalCalories} kcal</div>";
            } else {
                echo "<p style='color:red;'>Oops! Couldn't get the result in proper format.</p>";
                echo "<pre>" . htmlspecialchars($rawContent) . "</pre>";
            }
            ?>
            <a class='back-btn' href='calorie_input.php'>Back to Input</a>
        </div>
    </div>
<?php
}
?>
