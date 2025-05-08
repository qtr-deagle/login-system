<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Error Message</title>
    <style>
        .error-message {
            display: flex;
            align-items: center;
            padding: 16px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #b91c1c;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            background-color: #fef2f2;
        }
    </style>
</head>
<body>
    <?php
    $error = "Something went wrong! Please try again.";
    echo "<div class='error-message'>$error</div>";
    ?>
</body>
</html>
