<?php
require 'includes/db.php';

// Load the .env file
loadEnv(__DIR__ . '/includes/.env');
$openai_api_key = $_ENV['OPENAI_API_KEY'];

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$gender = $_POST['gender'];
$goal = $_POST['goal'];

// Step 1: Build Prompt
$prompt = "Create a weekly diet plan for a $age-year-old $gender who is $height cm tall and weighs $weight kg. 
The goal is $goal. 
Format the response as JSON like:
{
  'monday': {
    'breakfast': {'name': 'Oatmeal with Banana', 'calories': 300},
    'brunch': {...},
    'lunch': {...},
    'dinner': {...}
  },
  'tuesday': { ... },
  ...
}";

// Step 2: Call OpenAI API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $openai_api_key
]);

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'user', 'content' => $prompt]
    ],
    'temperature' => 0.7
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

// Step 3: Parse JSON Response
$responseData = json_decode($response, true);
$chatContent = $responseData['choices'][0]['message']['content'] ?? '';

$mealPlan = json_decode($chatContent, true);

if (!$mealPlan) {
    echo "Invalid plan received. Try again.";
    exit();
}

// Step 4: Insert into MySQL
$stmt = $conn->prepare("INSERT INTO diet_plan (user_id, day, meal_type, meal_name, calories) VALUES (?, ?, ?, ?, ?)");

foreach ($mealPlan as $day => $meals) {
    foreach ($meals as $mealType => $mealData) {
        $stmt->bind_param("isssi", $user_id, $day, $mealType, $mealData['name'], $mealData['calories']);
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

header("Location: view_diet_plan.php");
exit();
?>
