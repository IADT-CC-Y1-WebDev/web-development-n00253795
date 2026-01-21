<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/02-statements.php">View Example &rarr;</a>
    </div>

    <h1>Statements Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Age Classifier</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for age. Use if/else statements to classify and 
        display the age group: "Child" (0-12), "Teenager" (13-19), "Adult" 
        (20-64), or "Senior" (65+).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $age = rand(0,100);

        if($age <=12) {
            echo "<p>Age Group: Child</p>";
        }
        else if($age >=13 and $age <=19) {
            echo "<p>Age Group: Teenager</p>";
        }
        else if($age >=20 and $age <=64) {
            echo "<p>Age Group: Adult</p>";
        }
        else if($age >64) {
            echo "<p>Age Group: Senior</p>";
        }
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Day of the Week</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for the day of the week (use a number 1-7). Use 
        a switch statement to display whether it's a "Weekday" or "Weekend", 
        and the day name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $day = rand(1, 7);
        if ($day <=5) {
        echo "<p>Weekday</p>";}

        else if($day >5) {
            echo "<p>Weekend</p>";
        }
        switch ($day) {
            case (1):
                echo "<p>Monday</p>";
            break;
            case (2):
                echo "<p>Tuesday</p>";
            break;
            case (3):
                echo "<p>Wednesday</p>";
            break;
            case (4):
                echo "<p>Thursday</p>";
            break;
            case (5):
                echo "<p>Friday</p>";
            break;
            case (6):
                echo "<p>Saturday</p>";
            break;
            case (7):
                echo "<p>Sunday</p>";
            break;
        }


        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiplication Table</h2>
    <p>
        <strong>Task:</strong> 
        Use a for loop to create a multiplication table for a number of your 
        choice (1 through 10). Display each line in the format "X × Y = Z".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        
        $number = 5;
        echo "<p>Multiplication table for $number:</p>";
    for ($i = 1; $i <= 10; $i++) {
        $result = $number * $i;
        echo "<p>$number × $i = $result</p>";
    }


        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Countdown Timer</h2>
    <p>
        <strong>Task:</strong> 
        Create a countdown from 10 to 0 using a while loop. Display each number, 
        and when you reach 0, display "Blast off!"
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        
        $countdown = 10;
        while ($countdown > 0) {
            echo "<p>$countdown</p>";
            $countdown = $countdown - 1;
        }

echo "<p>0</p>";
echo "<p>Blast off!</p>";

        ?>
    </div>

</body>
</html>
