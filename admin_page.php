<?php

session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="user-box">
        <h1>Welcome, <span><?= isset($_SESSION['name']) ? strtoupper($_SESSION['name']) : 'Guest'; ?></span></h1>
        <p>This is an <span>Admin </span>page</p>
        <div class="action-buttons">
            <button onclick="window.location.href='logout.php'">Logout</button>
            <button onclick="window.location.href='change_password.php'">Change Password</button>
        </div>
    </div>
       
</body>

</html>