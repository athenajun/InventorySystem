<?php include_once("dbconnect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url(dearjoe1.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            padding: 1rem;
            color: black;
        }

        .logo {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        p {
            margin: 1rem 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 1rem;
            text-decoration: none;
            color: black;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }

        @media (max-width: 480px) {
            .logo {
                width: 40px;
                height: 40px;
            }

            form {
                padding: 1.5rem;
            }

            input[type="submit"] {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <img src="coffee2.jpg" alt="Coffee Logo" class="logo">
    <form action="" method="post">
        <h2>Login</h2>
        <span class="error-message"><?= isset($errorMessage) ? $errorMessage : '' ?></span>
        <p>EMPLOYEE ID: <input type="text" name="employee-id" required></p>
        <p>PASSWORD: <input type="password" name="password" required></p>
        <input type="submit" value="Login" name="login">
        <a href="register.php">Register</a>
    </form>

    <?php
    if (isset($_POST['login'])) {
        $employee_id = $_POST['employee-id'];
        $password = $_POST['password'];

        $query = "SELECT * FROM employee_table WHERE employee_id = '$employee_id' AND `password` = '$password' AND `role` = 'manager'";
        $statement = mysqli_query($connection, $query);
        $result = mysqli_num_rows($statement);

        if ($result == 1) {
            echo "<script>window.alert('Login Successfully'); window.location.href='index.php';</script>";
        } else {
            echo "<script>window.alert('Login unsuccessful, Only managers can login');</script>";
        }
    }
    ?>
</body>
</html>
