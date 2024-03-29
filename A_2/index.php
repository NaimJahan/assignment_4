<?php
include("./class.php");
$collatzProgram = new myCollatzProgram();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collatz Conjecture Calculator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input {
            padding: 10px;
            margin: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2>Collatz Conjecture Calculator</h2>
    <form action="./" method="GET">
        Enter a number to start the sequence: <input type="number" name="start_number" required />
        <input type="submit" name="calculate" value="Calculate" />
    </form>

    <?php
    if (isset($_GET["calculate"])) {
        $inputNumber = abs($_GET["start_number"]);

        $sequenceArray = $collatzProgram->collatz($inputNumber);
        $iterationCount = count($sequenceArray) - 1;
        $maxArrayNumber = max($sequenceArray);

        echo "<p>The Iteration is $iterationCount and The Maximum Number is " . $maxArrayNumber . "</p>";
        echo "<p>The Collatze Sequence for " . $inputNumber . " is: ";
        foreach ($sequenceArray as $arrayElement) {
            echo $arrayElement . ", ";
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
            $mySeqRangeArr = $collatzProgram->collatzSequenceInRange($num_1, $num_2);

            echo "<h2>Collatz Sequence Range</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($mySeqRangeArr as $ar1) {
                echo "<tr>";
                echo "<td>" . $ar1["number"] . "</td>";
                echo "<td>" . $ar1["highest_number"] . "</td>";
                echo "<td>" . $ar1["iteration"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            $maxVal = max(array_column($mySeqRangeArr, 'iteration'));
            $minVal = min(array_column($mySeqRangeArr, 'iteration'));

            echo "<br><p>Maximum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($mySeqRangeArr as $ar1) {
                if ($ar1["iteration"] == $maxVal) {
                    echo "<tr>";
                    echo "<td>" . $ar1["number"] . "</td>";
                    echo "<td>" . $ar1["highest_number"] . "</td>";
                    echo "<td>" . $ar1["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";

            echo "<br><p>Minimum Iteration:</p>";
            echo "<table border='1'>";
            echo "<tr><th>Number</th><th>Max Number</th><th>Iteration</th></tr>";

            foreach ($mySeqRangeArr as $ar1) {
                if ($ar1["iteration"] == $minVal) {
                    echo "<tr>";
                    echo "<td>" . $ar1["number"] . "</td>";
                    echo "<td>" . $ar1["highest_number"] . "</td>";
                    echo "<td>" . $ar1["iteration"] . "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
        } else {
            echo "Please enter the correct number!";
        }
        echo "<style>";
        echo "h2 { text-align: center; margin-bottom: 10px; }";
        echo "form { text-align: center; margin-bottom: 20px; }";
        echo "table { width: 50%; margin: auto; border-collapse: collapse; }";
        echo "th, td { border: 1px solid black; padding: 8px; text-align: center; }";
        echo "</style>";
    }
?>

</body>

</html>