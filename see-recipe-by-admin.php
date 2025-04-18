<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "recepie");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipe = null;

if (isset($_GET['dish'])) {
    $dish = urldecode($_GET['dish']);

    $sql = "SELECT * FROM recipes WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dish);
    $stmt->execute();
    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();

    if (!$recipe) {
        echo "<p class='text-center text-red-500 font-bold text-lg mt-10'>Recipe not found.</p>";
        exit();
    }
} else {
    echo "<p class='text-center text-red-500 font-bold text-lg mt-10'>Invalid Request.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['name'] ?? 'Recipe'); ?> - Recipe Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('view.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }
        .recipe-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        .recipe-card:hover {
            transform: scale(1.02);
        }
        .highlight {
            color: #d97706;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 recipe-card">
    <h2 class="text-center text-5xl font-bold text-orange-600 hover:text-orange-500 transition-all duration-300">
        <?php echo htmlspecialchars($recipe['name'] ?? 'Unknown Recipe'); ?>
    </h2>
    
    <div class="flex justify-center mt-4">
        <img src="<?php echo htmlspecialchars($recipe['image'] ?? 'default.jpg'); ?>" class="w-2/3 h-48 object-cover rounded-lg shadow-md" alt="Recipe Image">
    </div>

    <div class="mt-6">
        <h3 class="text-3xl font-semibold text-gray-800 border-b-2 border-orange-400 pb-2 text-center">Ingredients</h3>
        <p class="text-xl text-green-800 mt-4 leading-relaxed bg-yellow-100 p-4 rounded-lg hover:bg-yellow-200 transition-all font-cursive whitespace-pre-line">
            <?php 
                echo isset($recipe['ingredients']) 
                    ? nl2br(htmlspecialchars_decode($recipe['ingredients'])) 
                    : "No ingredients listed."; 
            ?>
        </p>
    </div>

    <div class="mt-6">
        <h3 class="text-3xl font-semibold text-gray-800 border-b-2 border-orange-400 pb-2 text-center">Method</h3>
        <p class="text-xl text-purple-800 mt-4 leading-relaxed bg-blue-100 p-4 rounded-lg hover:bg-blue-200 transition-all font-cursive whitespace-pre-line">
            <?php 
                echo isset($recipe['instructions']) 
                    ? nl2br(htmlspecialchars_decode($recipe['instructions'])) 
                    : "No instructions available."; 
            ?>
        </p>
    </div>

    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
        <p class="text-lg font-semibold text-blue-700 bg-gray-200 p-2 rounded-lg hover:bg-gray-300 transition">Calories: <span class='highlight'><?php echo htmlspecialchars($recipe['calories'] ?? 'N/A'); ?></span></p>
        <p class="text-lg font-semibold text-green-700 bg-gray-200 p-2 rounded-lg hover:bg-gray-300 transition">Protein: <span class='highlight'><?php echo htmlspecialchars($recipe['protein'] ?? 'N/A'); ?>g</span></p>
        <p class="text-lg font-semibold text-red-700 bg-gray-200 p-2 rounded-lg hover:bg-gray-300 transition">Fat: <span class='highlight'><?php echo htmlspecialchars($recipe['fat'] ?? 'N/A'); ?>g</span></p>
        <p class="text-lg font-semibold text-yellow-700 bg-gray-200 p-2 rounded-lg hover:bg-gray-300 transition">Carbs: <span class='highlight'><?php echo htmlspecialchars($recipe['carbs'] ?? 'N/A'); ?>g</span></p>
    </div>

    <div class="text-center mt-6">
        <a href="index.php" class="text-lg text-white bg-blue-600 px-6 py-3 rounded-full shadow-md hover:bg-blue-700 transition">
            ⬅ Back to Home
        </a>
    </div>

    
    <div class="text-center mt-6">
        <a href="recipe-feed.php?dish=<?php echo urlencode($recipe['name']); ?>" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition">
            ✍ Give Feedback
        </a>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
