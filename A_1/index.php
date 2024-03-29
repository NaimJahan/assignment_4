<?php
include("./functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture Calculator</title>
    <style>
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Collatz Conjecture Calculator</h2>
    <form action="./" method="POST"> 
        Enter a number to start the sequence: <input type="number" name="start_number" required />
        <input type="submit" name="calculate" value="Calculate" />
    </form>

    <?php
    if (isset($_POST["calculate"])) { 
        $inputNumber = abs($_POST["start_number"]);

        $mySequence = calculateCollatz($inputNumber);
        $iterationCount = count($mySequence) - 1;
        $maxArrayNumber = max($mySequence);

        echo "<p>The Iteration is $iterationCount and The Maximum Number is " . $maxArrayNumber . "</p>";
        echo "<p>The Collatz Sequence for " . $inputNumber . " is: ";
        foreach ($mySequence as $element) {
            echo $element . ", ";
        }
        echo "</p>";
    }
    ?>

    <br><br>

    <h2>Collatz Conjecture Calculator</h2>
    <form action="./" method="GET"> 
        Enter a start number: <input type="number" name="num_1" required />
        Enter an end number: <input type="number" name="num_2" required />
        <input type="submit" name="calc_range" value="Calculate" />
    </form>

    <?php
    if (isset($_GET["calc_range"])) {
        $num_1 = abs($_GET["num_1"]);
        $num_2 = abs($_GET["num_2"]);

        if ($num_2 > $num_1) {
            $sequenceRangeArr = collatzSequenceInRange($num_1, $num_2);

            echo "<h2>Collatz Sequence Range</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($sequenceRangeArr as $ar) {
                echo "<tr>";
                echo "<td>" . $ar["number"] . "</td>";
                echo "<td>" . $ar["highest_number"] . "</td>";
                echo "<td>" . $ar["iteration"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            $maxIteration = max(array_column($sequenceRangeArr, 'iteration'));
            $minIteration = min(array_column($sequenceRangeArr, 'iteration'));

            echo "<br><p>Maximum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($sequenceRangeArr as $ar) {
                if ($ar["iteration"] == $maxIteration) {
                    echo "<tr>";
                    echo "<td>" . $ar["number"] . "</td>";
                    echo "<td>" . $ar["highest_number"] . "</td>";
                    echo "<td>" . $ar["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";

            echo "<br><p>Minimum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($sequenceRangeArr as $ar) {
                if ($ar["iteration"] == $minIteration) {
                    echo "<tr>";
                    echo "<td>" . $ar["number"] . "</td>";
                    echo "<td>" . $ar["highest_number"] . "</td>";
                    echo "<td>" . $ar["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
        } else {
            echo "Please enter the correct number!";
        }
    }
    ?>

</body>

</html>
