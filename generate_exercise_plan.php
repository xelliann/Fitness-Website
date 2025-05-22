<?php
session_start();

require 'includes/db.php';

loadEnv(__DIR__ . '/includes/.env');
$openai_api_key = $_ENV['OPENAI_API_KEY'];

if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$gender = $_POST['gender'];
$goal = $_POST['goal'];

// Step 1: Build Prompt
$prompt = "Create a detailed 7-day exercise plan for a $age-year-old $gender who is $height cm tall and weighs $weight kg. 
The fitness goal is $goal. 
For each day, provide 3 to 5 exercises targeting different muscle groups or fitness components. 
Include at least one rest or active recovery day. 
Format the response strictly as JSON with keys as days of the week ('monday', 'tuesday', etc.), and each day having an array of exercises. 
Each exercise must have a 'name' and either 'reps' or 'duration'. 
Example format:
{
  'monday': [
    {'name': 'Bench Press', 'reps': '3 sets of 10'},
    {'name': 'Squats', 'reps': '3 sets of 12'},
    {'name': 'Jump Rope', 'duration': '5 minutes'}
  ],
  'tuesday': [
    {'name': 'Deadlifts', 'reps': '3 sets of 8'},
    {'name': 'Pull-ups', 'reps': '3 sets of 10'},
    {'name': 'Plank', 'duration': '1 minute'}
  ],
  ...
  'sunday': [
    {'name': 'Rest Day'}
  ]
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

$exercisePlan = json_decode($chatContent, true);
if (!$exercisePlan) {
    echo "Invalid plan received. Try again.";
    exit();
}

// ✅ Step 4: Delete old plan (overwrite)
$deleteStmt = $conn->prepare("DELETE FROM exercise_plan WHERE user_id = ?");
$deleteStmt->bind_param("i", $user_id);
$deleteStmt->execute();
$deleteStmt->close();

// ✅ Step 5: Store new plan
$stmt = $conn->prepare("INSERT INTO exercise_plan (user_id, day, exercise_name, reps_or_duration) VALUES (?, ?, ?, ?)");

foreach ($exercisePlan as $day => $exercises) {
    foreach ($exercises as $exercise) {
        $name = $exercise['name'];
        $reps_or_duration = $exercise['reps'] ?? $exercise['duration'] ?? '';
        $stmt->bind_param("isss", $user_id, $day, $name, $reps_or_duration);
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

header("Location: view_exercise_plan.php");
exit();
?>
