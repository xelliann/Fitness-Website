<?php
include 'partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input values
    $weight = $_POST['weight']; // Weight in kg
    $height = $_POST['height']; // Height in cm

    if (empty($weight) || empty($height)) {
        echo "<p style='color:red;'>Please provide valid weight and height.</p>";
        exit();
    }

    // Convert height from cm to meters
    $heightInMeters = $height / 100;

    // Calculate BMI
    $bmi = $weight / ($heightInMeters * $heightInMeters);

    // Determine BMI Category
    $bmiCategory = '';
    if ($bmi < 18.5) {
        $bmiCategory = 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        $bmiCategory = 'Normal weight';
    } elseif ($bmi >= 25 && $bmi <= 29.9) {
        $bmiCategory = 'Overweight';
    } else {
        $bmiCategory = 'Obesity';
    }

    // Display Result
    echo "<div class='exe1'>";
    echo "<div class='result-box'>";
    echo "<h2>Your BMI: " . round($bmi, 2) . "</h2>";
    echo "<p>Category: <strong>$bmiCategory</strong></p>";
    echo "<a class='back-btn' href='bmi_input.php'>Back to Input</a>";
    echo "</div>";
    echo "</div>";
}

include 'partials/footer.php';
?>
