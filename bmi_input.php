<?php
include 'partials/header.php'; 
?>
<!-- BMI Calculator Form -->
<div class="bmi-calculator">
    <div class="ex1">
        BMI Calculator
    </div>
    <form method="POST" action="bmi_calculator.php">
        <label for="weight">Weight (kg):</label>
        <input type="number" name="weight" id="weight" required>
        
        <label for="height">Height (cm):</label>
        <input type="number" name="height" id="height" required>

        <button type="submit">Calculate BMI</button>
    </form>
</div>
</div>
<?php
include 'partials/footer.php';
?>
