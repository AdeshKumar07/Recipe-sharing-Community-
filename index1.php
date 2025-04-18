<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Recipe Sharing</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
    body {
      background-image: url('https://images.unsplash.com/photo-1565958011703-44f9829ba187');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen relative px-4">
  <div class="absolute inset-0 bg-black bg-opacity-50"></div>
  <div class="container mx-auto p-6 relative">
    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-yellow-400 text-center mb-6 drop-shadow-lg tracking-wide">
      🍽️ Recipe Sharing Platform 🍽️
    </h1>

    <div class="bg-white p-6 sm:p-10 rounded-2xl shadow-2xl max-w-lg mx-auto backdrop-blur-md bg-opacity-95 border-4 border-yellow-500">
      <h2 class="text-3xl sm:text-4xl font-bold mb-6 text-gray-900 text-center underline decoration-yellow-400">
        Post a Recipe
      </h2>
      <form action="request_recipe.php" method="POST" class="space-y-6">
        <div>
          <label class="block mb-2 text-lg font-bold text-gray-900">🍜 Recipe Name</label>
          <input type="text" name="recipe_name" class="w-full p-3 border-2 border-yellow-400 rounded-lg focus:ring-2 focus:ring-yellow-500 text-gray-900 text-lg" required>
        </div>

        <div>
          <label class="block mb-2 text-lg font-bold text-gray-900">📝 Ingredients</label>
          <textarea name="ingredients" class="w-full p-3 border-2 border-yellow-400 rounded-lg focus:ring-2 focus:ring-yellow-500 text-gray-900 text-lg" required></textarea>
        </div>

        <div>
          <label class="block mb-2 text-lg font-bold text-gray-900">📜 Instructions</label>
          <textarea name="instructions" class="w-full p-3 border-2 border-yellow-400 rounded-lg focus:ring-2 focus:ring-yellow-500 text-gray-900 text-lg" required></textarea>
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-white px-5 py-3 rounded-lg font-bold text-xl sm:text-2xl shadow-md hover:bg-yellow-600 transition duration-300 flex items-center justify-center gap-3">
          🍕 Submit Recipe 🍔
        </button>
      </form>
    </div>
  </div>
</body>
</html>
