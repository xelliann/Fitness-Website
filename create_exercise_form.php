    <?php
    include 'partials/header.php';
    ?>

    <div class="h1">
    Create Your Weekly Exercise Plan</div>
    <div class="form1">
            <form action="generate_exercise_plan.php" method="POST" class="form-box">
            <div>
                <label for="age">Age:</label>
                <input type="number" name="age" required>
            </div>
            <div>
                <label for="weight">Weight (kg):</label>
                <input type="number" name="weight" required>  
            </div>  
            <div>
                <label for="height">Height (cm):</label>
                <input type="number" name="height" required>
            </div>  
            <div>
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>  
                <div>
                    <label for="goal">Fitness Goal:</label>
                    <select name="goal" required>
                        <option value="weight loss">Weight Loss</option>
                        <option value="muscle gain">Muscle Gain</option>
                        <option value="general fitness">General Fitness</option>
                    </select>
                </div>


                <button type="submit" class="btn">Generate Plan</button>
            </form>
        </div>
    </body>
    </html>
