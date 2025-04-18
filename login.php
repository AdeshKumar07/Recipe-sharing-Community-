<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RecipeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-bold text-yellow-600 text-center">Login</h2>
        <p class="text-center text-gray-600 mt-2">Select your role to continue</p>

        
        <div class="mt-4">
            <select id="userType" class="w-full p-2 border rounded-lg" onchange="showLoginForm()" required>
                <option value="" disabled selected>Select Role</option>
                <option value="user">User Login</option>
                <option value="admin">Admin Login</option>
            </select>
        </div>


        <form id="loginForm" action="loginprocess.php" method="POST" class="mt-6 hidden">
            
            <input type="hidden" name="role" id="roleInput">


            <label class="block text-gray-700 mt-3">Email:</label>
            <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1" placeholder="you@example.com" required>

            
            <label class="block text-gray-700 mt-3">Password:</label>
            <input type="password" name="password" class="w-full p-2 border rounded-lg mt-1" placeholder="••••••••" required>

            
            <button type="submit" class="mt-4 w-full px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Login</button>
        </form>

        
        <p class="text-center text-gray-600 mt-4">
            Don't have an account?
            <a href="register.php" class="text-blue-500 hover:underline">Sign Up</a>
        </p>
    </div>

    <script>
        function showLoginForm() {
            let userType = document.getElementById("userType").value;
            document.getElementById("roleInput").value = userType;
            document.getElementById("loginForm").classList.remove("hidden");
        }
    </script>

</body>
</html>
