<?php

session_start(); // Start the session

// Include the database connection file
include 'config.php';

$homePage = 'user_page.php';
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $homePage = 'admin_page.php';
}

$errors = [
    'change_password' => $_SESSION['update_password_error'] ?? ''
];

$success = [
    'change_password' => $_SESSION['update_password_success'] ?? ''
];

/**
 * Displays the status message for the change password operation.
 *
 * @param array $errors  An associative array of error messages.
 * @param array $success An associative array of success messages.
 * 
 * @return string The error or success message for the change password operation, or an empty string if none exist.
 */
function showStatus($errors, $success) {
    if (!empty($errors['change_password'])) {
        return showError($errors['change_password']);
    } elseif (!empty($success['change_password'])) {
        return showSuccess($success['change_password']);
    }
    return '';
}

function showError($error) {
    if (!empty($error)) {
        unset($_SESSION['update_password_error']);
        return "<p class='error-message'>$error</p>";
    }
    return '';
}

function showSuccess($success) {
    if (!empty($success)) {
        unset($_SESSION['update_password_success']);
        return "<p class='success-message'>$success</p>";
    }
    return '';
}

if (isset($_POST['update_result'])) {
    $current_password = $_POST['current_password'];
    $current_password = mysqli_real_escape_string($conn, $current_password);
    $current_password = htmlentities($current_password);
    
    $new_password = $_POST['new_password'];
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $new_password = htmlentities($new_password);

    $confirm_password = $_POST['confirm_password'];
    $confirm_password = mysqli_real_escape_string($conn, $confirm_password);
    $confirm_password = htmlentities($confirm_password);

    $email = $_SESSION['email'];

    // Fetch the current password from the database
    $query = "SELECT password FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    /**
     * Handles the password change process for a user.
     * 
     * - Verifies if the provided current password matches the stored password.
     * - Checks if the new password and confirm password match.
     * - Updates the user's password in the database if all conditions are met.
     * - Sets appropriate session messages for success or error scenarios.
     * - Redirects the user back to the change password page after processing.
     */
    if (password_verify($current_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $_SESSION['update_password_success'] = 'Password Successfully updated!';
                header("Location: change_password.php");
            } else {
                $_SESSION['update_password_error'] = 'Sorry, Something went wrong, Please Try Again.';
                header("Location: change_password.php");    
            }
        } else {
            $_SESSION['update_password_error'] = 'Passwords do not match!';
            header("Location: change_password.php");
        }
    } else {
        $_SESSION['update_password_error'] = 'Current password is incorrect!';
        header("Location: change_password.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box-password" id="change-password-form">
        <?= showStatus($errors, $success) ?>
        <h2>Change Password</h2>
        <form method="post" action="change_password.php">
            <input type="password" name="current_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="update_result">Change Password</button>
        </form>
    </div>
    <script src="script.js"></script>

</body>
</html>
