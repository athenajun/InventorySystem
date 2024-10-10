<?php 
include_once("dbconnect.php");

global $errorMessage, $successfullRegister;

if (isset($_POST['register'])) {
    $employee_id = $_POST['employee-id'];

    $errorMessage = "";
    $successfullRegister = "";
    
    // Check if the employee ID already exists
    $queryCheck = "SELECT * FROM employee_table WHERE employee_id = ?";
    $stmt = $connection->prepare($queryCheck);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Employee ID already exists
        $errorMessage = "Employee ID already exists. Please use a different ID.";
    } else {
        // Proceed with registration if employee ID is not duplicate
        $surname = $_POST['surname']; 
        $fullname = $_POST['fullname']; 
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        $sql = "INSERT INTO employee_table (employee_id, username, fullname, `password`, `role`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issss", $employee_id, $surname, $fullname, $password, $role);
        
        if ($stmt->execute()) {
            $successfullRegister = "Employee registered successfully!";
        } else {
            echo "Error: " . $connection->error;
        }
    }

    $stmt->close();
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register an Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
body {
    font-family: 'Roboto', sans-serif;
    background-image: url(dearjoe1.png); /* Update with your image path */
    background-size: cover; /* Cover the entire background */
    background-position: center; /* Center the image */
    color: #EAEAEA; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 1rem;
}

        form {
            background-color: #1E1E1E; /* Slightly lighter dark for the form */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 400px;
            border: 1px solid #3C3C3C; /* Darker border */
        }

        input {
            border: 1px solid #3C3C3C; /* Darker border for inputs */
            border-radius: 4px;
            padding: 0.5rem;
            font-size: 1rem;
            width: 100%;
            margin-top: 0.5rem;
            outline: none;
            transition: border-color 0.3s;
            background-color: #2C2C2C; /* Dark input background */
            color: #EAEAEA; /* Light text for inputs */
        }

        input:focus {
            border-color: #FFB74D; /* Golden focus color */
            background-color: #3C3C3C; /* Slightly lighter on focus */
        }

        .submit-btn {
            background-color: #FFB74D; /* Golden button */
            color: #121212; /* Dark text */
            padding: 0.75rem;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #FFA000; /* Darker gold on hover */
        }

        a {
            color: #FFB74D; /* Golden link color */
            text-decoration: none;
            margin-top: 1rem;
            display: block;
            text-align: center;
            transition: color 0.3s;
        }

        a:hover {
            color: #FFA000; /* Darker gold on hover */
        }

        span {
            color: #FF5252; /* Red for error messages */
            display: block;
            margin-top: 0.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h2 class="text-center font-bold">Register an Account</h2>
        <span><?= $successfullRegister ?></span>
        <p>Enter your Employee-ID: <input type="number" name="employee-id" required></p>
        <span><?= $errorMessage ?></span>
        <p>Enter your Username: <input type="text" name="surname" required></p>
        <p>Enter your Full Name: <input type="text" name="fullname" required></p>
        <p>Enter your Password: <input type="password" name="password" required></p>
        <p>Enter your Role: <input type="text" name="role" required></p>
        <input class="submit-btn" type="submit" value="Register" name="register">
        <a href="login.php">Login</a>
    </form>
</body>
</html>
