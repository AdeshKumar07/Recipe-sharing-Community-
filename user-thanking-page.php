<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Sharing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            background-image: url('https://images.unsplash.com/photo-1565958011703-44f9829ba187')
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="container mx-auto p-6 relative">
        <div class="bg-white p-8 sm:p-12 rounded-3xl shadow-2xl max-w-lg mx-auto backdrop-blur-md bg-opacity-90 border-4 border-yellow-500">
            <h1 class="text-5xl sm:text-6xl font-extrabold text-yellow-400 text-center mb-8 drop-shadow-lg tracking-wide">🍽️ Thank You! 🍽️</h1>
            <p class="text-3xl sm:text-4xl text-gray-900 text-center font-semibold">
                <?php
                if (isset($_SESSION['success_message'])) {
                    echo $_SESSION['success_message'];
                    unset($_SESSION['success_message']);
                } else {
                    echo "Thank you for sharing your delicious recipe with us!";
                }
                ?>
            </p>
            <div class="mt-6 text-center">
                <a href="index1.php" class="inline-block bg-yellow-500 text-white px-6 py-3 rounded-lg font-bold text-xl sm:text-2xl shadow-md hover:bg-yellow-600 transition duration-300">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
