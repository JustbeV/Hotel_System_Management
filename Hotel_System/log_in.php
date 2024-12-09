<?php
    include('db.php');
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Prepare the SQL query using PDO
        $sql = "SELECT * FROM users WHERE Email = :email AND PasswordHash = :password";
        $stmt = $conn->prepare($sql);
        
        // Bind the parameters to prevent SQL injection
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        // Execute the query
        $stmt->execute();

        // Use rowCount() instead of num_rows for PDO
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['userID'] = $user['UserID'];
            $_SESSION['role'] = $user['Role'];
            $_SESSION['name'] = $user['Name'];
            
            // Redirect based on user role
            if ($user['Role'] === 'Admin') {
                header('Location: admin_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            echo "Invalid email or password.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="POST">
    <label>Email:</label><input type="email" name="email" required><br>
    <label>Password:</label><input type="password" name="password" required><br>
    <button type="submit" name="login">Login</button>
    <button type="submit" name="register">Register</button>
</form>
</body>
</html>
