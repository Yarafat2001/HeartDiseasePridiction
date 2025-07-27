<?php
$result = ""; // Initialize result message
$form_data = []; // Array to hold form values for repopulation

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $form_data['age'] = $_POST['age'];
    $form_data['sex'] = $_POST['sex'];
    $form_data['cp'] = $_POST['cp'];
    $form_data['trestbps'] = $_POST['trestbps'];
    $form_data['chol'] = $_POST['chol'];
    $form_data['fbs'] = $_POST['fbs'];
    $form_data['restecg'] = $_POST['restecg'];
    $form_data['thalach'] = $_POST['thalach'];
    $form_data['exang'] = $_POST['exang'];
    $form_data['oldpeak'] = $_POST['oldpeak'];
    $form_data['slope'] = $_POST['slope'];
    $form_data['ca'] = $_POST['ca'];
    $form_data['thal'] = $_POST['thal'];

    $command = "python \"C:/xampp/htdocs/New folder (4)/predict.py\" " .
    escapeshellarg($form_data['age']) . " " .
    escapeshellarg($form_data['sex']) . " " .
    escapeshellarg($form_data['cp']) . " " .
    escapeshellarg($form_data['trestbps']) . " " .
    escapeshellarg($form_data['chol']) . " " .
    escapeshellarg($form_data['fbs']) . " " .
    escapeshellarg($form_data['restecg']) . " " .
    escapeshellarg($form_data['thalach']) . " " .
    escapeshellarg($form_data['exang']) . " " .
    escapeshellarg($form_data['oldpeak']) . " " .
    escapeshellarg($form_data['slope']) . " " .
    escapeshellarg($form_data['ca']) . " " .
    escapeshellarg($form_data['thal']);

// Execute the Python script and capture the output
$result = shell_exec($command);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Disease Prediction</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #191369;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 600px;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            text-align: center;
            font-size: 1.8em;
            color: #4facfe;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-gap: 15px;
        }

        label {
            font-weight: 600;
        }

        input, select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #4facfe;
            outline: none;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.5);
        }

        button {
            padding: 12px;
            font-size: 1em;
            background-color: #4facfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00c6ff;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f7ef;
            border: 1px solid #b2dfdb;
            border-radius: 5px;
            color: #388e3c;
            font-weight: bold;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Heart Disease Prediction</h1>
        <form method="post">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required value="<?= htmlspecialchars($age ?? '') ?>">

            <label for="sex">Sex</label>
            <select name="sex" id="sex" required>
                <option value="0" <?= isset($sex) && $sex == "0" ? "selected" : "" ?>>Female</option>
                <option value="1" <?= isset($sex) && $sex == "1" ? "selected" : "" ?>>Male</option>
            </select>

            <label for="cp">Chest Pain Type</label>
            <input type="number" name="cp" id="cp" required value="<?= htmlspecialchars($cp ?? '') ?>">

            <label for="trestbps">Resting Blood Pressure</label>
            <input type="number" name="trestbps" id="trestbps" required value="<?= htmlspecialchars($trestbps ?? '') ?>">

            <label for="chol">Cholesterol</label>
            <input type="number" name="chol" id="chol" required value="<?= htmlspecialchars($chol ?? '') ?>">

            <label for="fbs">Fasting Blood Sugar</label>
            <select name="fbs" id="fbs" required>
                <option value="0" <?= isset($fbs) && $fbs == "0" ? "selected" : "" ?>>False</option>
                <option value="1" <?= isset($fbs) && $fbs == "1" ? "selected" : "" ?>>True</option>
            </select>

            <label for="restecg">Resting ECG Results</label>
            <input type="number" name="restecg" id="restecg" required value="<?= htmlspecialchars($restecg ?? '') ?>">

            <label for="thalach">Max Heart Rate</label>
            <input type="number" name="thalach" id="thalach" required value="<?= htmlspecialchars($thalach ?? '') ?>">

            <label for="exang">Exercise-Induced Angina</label>
            <select name="exang" id="exang" required>
                <option value="0" <?= isset($exang) && $exang == "0" ? "selected" : "" ?>>No</option>
                <option value="1" <?= isset($exang) && $exang == "1" ? "selected" : "" ?>>Yes</option>
            </select>

            <label for="oldpeak">ST Depression</label>
            <input type="number" step="0.1" name="oldpeak" id="oldpeak" required value="<?= htmlspecialchars($oldpeak ?? '') ?>">

            <label for="slope">Slope of Peak</label>
            <input type="number" name="slope" id="slope" required value="<?= htmlspecialchars($slope ?? '') ?>">

            <label for="ca">Number of Major Vessels</label>
            <input type="number" name="ca" id="ca" required value="<?= htmlspecialchars($ca ?? '') ?>">

            <label for="thal">Thalassemia</label>
            <input type="number" name="thal" id="thal" required value="<?= htmlspecialchars($thal ?? '') ?>">

            <button type="submit">Predict</button>
        </form>
        <?php if (isset($result)): ?>
            <div class="result">
                <p><?= htmlspecialchars($result) ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
