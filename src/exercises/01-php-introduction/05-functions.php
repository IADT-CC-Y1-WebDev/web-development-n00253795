<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/05-functions.php">View Example &rarr;</a>
    </div>

    <h1>Functions Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Temperature Converter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called celsiusToFahrenheit() that takes a Celsius temperature as a parameter and returns the Fahrenheit equivalent. Formula: F = (C × 9/5) + 32. Test it with a few values.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function celsiusToFahrenheit($celsius) {
            $fahrenheit = ($celsius * 9/5) + 32;
            return $fahrenheit;
}

    $temp1 = 0;
    $temp2 = 25;
    $temp3 = 100;

        echo "<p>$temp1 °C is " . celsiusToFahrenheit($temp1) . "°F.</p>";
        echo "<p>$temp2 °C is " . celsiusToFahrenheit($temp2) . "°F.</p>";
        echo "<p>$temp3 °C is " . celsiusToFahrenheit($temp3) . "°F.</p>";

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Rectangle Area</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called calculateRectangleArea() that takes width
         and height as parameters. It should return the area. If only one 
         parameter is provided, assume it's a square (both dimensions equal).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function calculateRectangleArea($width, $height = null) {

    if ($height === null) {
        $height = $width;
    }
    $area = $width * $height;
    return $area;
}
    echo "<p>Rectangle 5 x 10: Area = " . calculateRectangleArea(5, 10) . "</p>";
    echo "<p>Square 7 x 7: Area = " . calculateRectangleArea(7) . "</p>";
    echo "<p>Rectangle 8 x 3: Area = " . calculateRectangleArea(8, 3) . "</p>";

        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Even or Odd</h2>
    <p>
        <strong>Task:</strong>
        Create a function called checkEvenOdd() that takes a number and returns 
        "Even" if the number is even, or "Odd" if it's odd. Use the modulo 
        operator (%).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        function checkEvenOdd($number) {
    if ($number % 2 === 0) {
        return "Even";
    } else {
        return "Odd";
    }
}

    echo "<p>Number 4 is " . checkEvenOdd(4) . ".</p>";
    echo "<p>Number 7 is " . checkEvenOdd(7) . ".</p>";
    echo "<p>Number 0 is " . checkEvenOdd(0) . ".</p>";
    echo "<p>Number -3 is " . checkEvenOdd(-3) . ".</p>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Array Statistics</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called getArrayStats() that takes an array of numbers 
        and returns an array with three values: minimum, maximum, and average. 
        Use array destructuring to display the results.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
    function getArrayStats($numbers) {
    $min = min($numbers);
    $max = max($numbers);
    
    $average = array_sum($numbers) / count($numbers);
    
    return [$min, $max, $average];
}

    $nums = [4, 8, 15, 16, 23, 42];
    [$min, $max, $avg] = getArrayStats($nums);

    echo "<p>Numbers: " . implode(", ", $nums) . "</p>";
    echo "<p>Minimum: $min</p>";
    echo "<p>Maximum: $max</p>";
    echo "<p>Average: $avg</p>";

        ?>
    </div>

</body>
</html>
