<!-- calorie_input.php -->
<?php
require 'partials/header.php';
?>

<div class="form1">
    <div class="ex1">
        Calorie Counter
    
    </div>
    <form action="calorie_prompt.php" method="POST">
        <label for="food_input">Enter the food you ate (e.g., 2 eggs, 1 banana, 1 glass of milk):</label>
        <textarea name="food_input" required></textarea>
        <button type="submit">Check Calories</button>
    </form>

</div>
</div>
<?php
include 'partials/footer.php';
?>
