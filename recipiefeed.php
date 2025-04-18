<?php
$conn = new mysqli("localhost", "root", "", "recepie");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dish = $_GET['dish'] ?? '';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $recipe_name = $_POST['recipe_name'];
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $comment = trim($_POST['comment']);

    if (!empty($user_name) && !empty($user_email) && !empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO feedback (recipe_name, user_name, user_email, comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $recipe_name, $user_name, $user_email, $comment);
        $stmt->execute();

        $message = $stmt->affected_rows > 0 
            ? "<p class='text-green-600 text-center mt-4 font-semibold'>Thank you for your feedback!</p>" 
            : "<p class='text-red-600 text-center mt-4 font-semibold'>Something went wrong. Try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Give Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-2xl mx-auto mt-12 bg-white p-8 rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold text-center text-orange-600 mb-6">Feedback for "<?php echo htmlspecialchars($dish); ?>"</h1>
    
    <form method="POST">
        <input type="hidden" name="recipe_name" value="<?php echo htmlspecialchars($dish); ?>">

        <input type="text" name="user_name" placeholder="Your Name" required class="w-full mb-4 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-400" />
        
        <input type="email" name="user_email" placeholder="Your Email" required class="w-full mb-4 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-400" />
        
        <textarea name="comment" rows="6" placeholder="Write your feedback..." required class="w-full mb-4 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-400"></textarea>
        
        <div class="text-center">
            <button type="submit" name="submit_feedback" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full transition">
                Submit Feedback
            </button>
        </div>
    </form>

    <?php if (!empty($message)) echo $message; ?>

    <div class="text-center mt-6">
        <a href="index.php" class="text-sm text-blue-600 hover:underline">⬅ Back to Home</a>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
