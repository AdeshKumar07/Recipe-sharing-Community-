<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; text-align: center; background-color: #fff7e6; }
        .thank-you-message { font-size: 3rem; font-family: 'Dancing Script', cursive; color: #ff6600; margin-top: 50px; }
        .back-link { font-size: 1.5rem; font-weight: bold; color: #0066cc; text-decoration: underline; margin-top: 20px; display: inline-block; }
        .back-link:hover { color: #ff3300; }
    </style>
</head>
<body>

<h1 class="thank-you-message">Thank You for Visiting!</h1>
<p class="text-2xl text-gray-700 mt-4">We appreciate your feedback and will get back to you soon.</p>

</body>
</html>
