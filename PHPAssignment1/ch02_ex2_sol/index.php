<?php 
    // variables
    $investment = '';
    $interest_rate = '';
    $years = '';
    $error_message = '';
    $future_value_f = '';

     // checks if the form was submitted
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // gets data from form
        $investment = filter_input(INPUT_POST, 'investment',
        FILTER_VALIDATE_FLOAT);
        $interest_rate = filter_input(INPUT_POST, 'interest_rate',
         FILTER_VALIDATE_FLOAT);
        $years = filter_input(INPUT_POST, 'years',
         FILTER_VALIDATE_INT);

         // validate the input
        if ($investment == 'false' || $investment <= 0) {
            $error_message .= 'Investment must be a number greater than zero.<br>';
        }
        if ($interest_rate === false || $interest_rate <= 0 || $interest_rate > 15) {
            $error_message .= 'Interest rate must be a number between 0 and 15.<br>';
        }
        if ($years === false || $years <= 0 || $years > 30) {
            $error_message .= 'Years must be a number between 1 and 10.<br>';
        }

        // if no errors calculate future value
        if (empty($error_message))  {
            $future_value = $investment;
            for ($i = 1; $i <= $years; $i++) {
                $future_value += $future_value * $interest_rate * 0.01;
            }

            $investment_f = '$'.number_format($investment, 2);
            $yearly_rate_f = $interest_rate. '%';
            $future_value_f = '$'.number_format($future_value, 2);

            $investment = '';
            $interest_rate = '';
            $years = '';
        }
    }

?> 
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <main>
    <h1>Future Value Calculator</h1>
    <?php if (!empty($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="display_results.php" method="post">

        <div id="data">
            <label>Investment Amount:</label>
            <input type="text" name="investment"
                   value="<?php echo htmlspecialchars($investment); ?>">
            <br>

            <label>Yearly Interest Rate:</label>
            <input type="text" name="interest_rate"
                   value="<?php echo htmlspecialchars($interest_rate); ?>">
            <br>

            <label>Number of Years:</label>
            <input type="text" name="years"
                   value="<?php echo htmlspecialchars(string: $years); ?>">
            <br>
        </div>

        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Calculate"><br>
        </div>

    </form>
    </main>
</body>
</html>