<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading System</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    position: absolute;
    pointer-events: none;
    left: 5px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Student Grading System</h2>
        <form id="gradingForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="subject">Subject:</label>
            <select id="subject" name="subject" required>
                <option value="Math">**Select Subject**</option>
                <option value="Math">Math</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
                <option value="English">English</option>
            </select>

            <label for="test1">First Test Score:</label>
            <input type="number" id="test1" name="test1" min="0" max="20" required>

            <label for="test2">Second Test Score:</label>
            <input type="number" id="test2" name="test2" min="0" max="20" required>

            <label for="exam">Exam Score:</label>
            <input type="number" id="exam" name="exam" min="0" max="100" required>

            <input type="submit" value="Submit">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate inputs
        $name = htmlspecialchars($_POST['name']);
        $subject = htmlspecialchars($_POST['subject']);
        $test1 = filter_input(INPUT_POST, 'test1', FILTER_VALIDATE_FLOAT);
        $test2 = filter_input(INPUT_POST, 'test2', FILTER_VALIDATE_FLOAT);
        $exam = filter_input(INPUT_POST, 'exam', FILTER_VALIDATE_FLOAT);

        // Calculate overall score
        $overall = $test1 + $test2 + $exam;

        // Determine grade
        if ($overall < 0 || $overall > 100) {
            $message = "Dear $name, you did not sit for the exam therefore, you are a disgrace to your parent.";
        } else if ($overall >= 70) {
            $grade = 'A';
        } else if ($overall >= 60) {
            $grade = 'B';
        } else if ($overall >= 50) {
            $grade = 'C';
        } else if ($overall >= 45) {
            $grade = 'D';
        } else if ($overall >= 40) {
            $grade = 'E';
        } else {
            $grade = 'F';
        }

        // Display the result in an alert
        echo "<script>alert('Dear $name, your first test score is $test1, your second test score is $test2, your exam score is $exam, your overall score is $overall. Your grade is $grade.');</script>";
    }
    ?>
</body>
</html>
