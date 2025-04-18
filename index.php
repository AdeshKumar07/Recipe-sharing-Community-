<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecipeHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Poppins:wght@300;400;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-cover bg-center bg-fixed" style="background-image: url('images/background.jpg');">


<div class="sticky top-0 left-0 w-full bg-white shadow-md flex items-center justify-between px-6 py-4 z-50">
    <a href="index1.php" class="text-lg font-bold px-5 py-2 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg transition-all hover:from-orange-600 hover:to-orange-700 hover:scale-105 transform duration-300" style="font-family: 'Dancing Script', cursive;">Upload Your Recipe</a>
    <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500" style="font-family: 'Dancing Script', cursive;">RecipeHub</h1>
    <div class="space-x-4">
        <a href="login.php" class="text-gray-700 text-lg hover:text-blue-500 hover:underline transition">Sign In</a>
        <a href="register.php" class="text-gray-700 text-lg hover:text-green-500 hover:underline transition">Register</a>
    </div>
</div>

<div class="mt-16"></div>

<div class="w-full px-4 md:px-8 lg:px-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    $recipes = [
        ["name" => "Butter Chicken", "image" => "images/butter_chicken.jpg"],
        ["name" => "Cheeseburger", "image" => "images/burger.jpg"],
        ["name" => "Chicken Biryani", "image" => "images/chicken_biryani.jpg"],
        ["name" => "Chocolate Cake", "image" => "images/chocolate_cake.jpg"],
        ["name" => "Creamy Pasta", "image" => "images/cream_pasta.jpg"],
        ["name" => "Margherita Pizza", "image" => "images/margherita_pizza.jpg"],
        ["name" => "Paneer Tikka", "image" => "images/paneer_tikka.jpg"],
        ["name" => "Cupcake", "image" => "images/cupcake.jpg"],
        ["name" => "Spring Rolls", "image" => "images/spring_rolls.jpg"]
    ];
    foreach ($recipes as $recipe) {
        echo '<div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition">';
        echo '<img src="' . $recipe["image"] . '" alt="' . $recipe["name"] . '" class="w-full h-64 object-cover rounded-lg transition-transform duration-300 hover:scale-105">';
        echo '<h3 class="text-2xl font-semibold mt-2 text-center text-orange-600" style="font-family: \"Dancing Script\", cursive;">' . $recipe["name"] . '</h3>';
        echo '<div class="text-center mt-2">';
        echo '<a href="see-recipe.php?dish=' . urlencode($recipe["name"]) . '" class="text-blue-500 text-lg font-semibold hover:underline hover:text-blue-700 transition">See Recipe</a>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>


<div class="mt-12 bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
    <h2 class="text-4xl font-bold text-yellow-600 text-center">Contact Us</h2>
    <p class="text-center text-lg text-gray-600 mt-2">We’d love to hear from you! Reach out with any questions or feedback.</p>
    <div class="mt-6 space-y-4 text-center">
        <p class="text-lg"><strong>Email:</strong> support@recipehub.com</p>
        <p class="text-lg"><strong>Phone:</strong> +1 234 567 890</p>
        <p class="text-lg"><strong>Location:</strong> 123 Recipe Street, Food City, FL</p>
    </div>
    <div class="mt-8 p-6 bg-gray-100 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4 text-center">Send Us Your Feedback</h3>
        <form action="thankyou.php" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold">Your Name:</label>
                    <input type="text" name="name" class="w-full p-2 border rounded-lg mt-1" placeholder="Enter your name" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-semibold">Your Email:</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-lg mt-1" placeholder="Enter your email" required>
                </div>
            </div>
            <label class="block text-gray-700 text-sm font-semibold mt-3">Message:</label>
            <textarea name="message" class="w-full p-2 border rounded-lg mt-1" rows="4" placeholder="Write your message..." required></textarea>
            <button type="submit" class="mt-4 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">Send Message</button>
        </form>
    </div>
</div>

</body>
</html>
