<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$result = '';
$errors = [];
$num1 = '';
$num2 = '';
$operation = 'add';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $operation = $_POST['operation'] ?? 'add';
    
    // Validate inputs
    if (!is_numeric($num1)) {
        $errors[] = "First number must be a valid number";
    }
    
    if (!is_numeric($num2)) {
        $errors[] = "Second number must be a valid number";
    }
    
    if (empty($errors)) {
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                break;
            case 'subtract':
                $result = $num1 - $num2;
                break;
            case 'multiply':
                $result = $num1 * $num2;
                break;
            case 'divide':
                if ($num2 == 0) {
                    $errors[] = "Division by zero is not allowed!";
                } else {
                    $result = $num1 / $num2;
                }
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .calculator {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 4px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .error {
            color: red;
            margin-top: 10px;
            padding: 10px;
            background-color: #ffe6e6;
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Basic PHP Calculator</h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="num1">First Number:</label>
                <input type="number" step="any" name="num1" id="num1" 
                       value="<?php echo htmlspecialchars($num1); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="operation">Operation:</label>
                <select name="operation" id="operation" required>
                    <option value="add" <?php echo $operation == 'add' ? 'selected' : ''; ?>>Addition (+)</option>
                    <option value="subtract" <?php echo $operation == 'subtract' ? 'selected' : ''; ?>>Subtraction (-)</option>
                    <option value="multiply" <?php echo $operation == 'multiply' ? 'selected' : ''; ?>>Multiplication (×)</option>
                    <option value="divide" <?php echo $operation == 'divide' ? 'selected' : ''; ?>>Division (÷)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="num2">Second Number:</label>
                <input type="number" step="any" name="num2" id="num2" 
                       value="<?php echo htmlspecialchars($num2); ?>" required>
            </div>
            
            <button type="submit">Calculate</button>
        </form>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif ($result !== ''): ?>
            <div class="result">
                <p>Result: <strong><?php echo htmlspecialchars($result); ?></strong></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>