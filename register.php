<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RecipeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-yellow-100">
        <h2 class="text-3xl font-bold text-yellow-600 text-center">Sign Up</h2>
        <p class="text-center text-gray-600 mt-2">Create an account to explore amazing recipes!</p>

        <form action="process_register.php" method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-gray-700">Full Name:</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <div>
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <div>
                <label class="block text-gray-700">Password:</label>
                <input type="password" name="password" class="w-full p-2 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <div>
                <label class="block text-gray-700">Contact Number:</label>
                <input type="text" name="contact" pattern="[0-9]{10}" title="Enter a valid 10-digit phone number" class="w-full p-2 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <div>
                <label class="block text-gray-700">Birth Date:</label>
                <input type="date" name="birthdate" class="w-full p-2 border rounded-lg mt-1 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
            </div>

            <button type="submit" class="mt-4 w-full px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition duration-200">Sign Up</button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>

</body>
</html>
