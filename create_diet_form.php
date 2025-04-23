<?php
include 'partials/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}
?>


<div class="h1">
    Create Your Weekly Diet Plan
</div>

<div class="form1">
    <form action="generate_diet_plan.php" method="POST">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" required>
            <label for="height">Height (cm):</label>
            <input type="number" id="height" name="height" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <label for="goal">Goal:</label>
            <select id="goal" name="goal" required>
                <option value="lose weight">Lose weight</option>
                <option value="maintain weight">Maintain weight</option>
                <option value="gain weight">Gain weight</option>
            </select>
        
        <button type="submit" class="btn btn-primary">Create Plan</button>
    </form>
</div>

<footer>
    <p>&copy; 2025 Your Diet Plan</p>
</footer>

</body>
</html>
