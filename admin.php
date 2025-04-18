<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "recepie");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, image FROM recipes WHERE status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Recipe Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
</head>
<body class="text-white">
    <div class="overlay"></div>

    <nav class="bg-yellow-500 p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Admin Panel</h1>
        <div>
            <a href="admin_dashboard.php" class="bg-white text-yellow-600 px-4 py-2 rounded-lg hover:bg-gray-200">Dashboard</a>
            <a href="?logout=true" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
        </div>
    </nav>

    
    <div class="text-center mt-6">
        <a href="request_recipe.php" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg font-bold text-xl sm:text-2xl shadow-md hover:bg-blue-600 transition duration-300">
            View Submitted Recipes
        </a>
    </div>

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-lg border border-yellow-400 mt-10 text-black">
        <h2 class="text-2xl font-semibold mb-4">Pending Recipes</h2>
        
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-yellow-300 text-gray-900">
                    <th class="p-3 border border-gray-400">Recipe Name</th>
                    <th class="p-3 border border-gray-400">Image</th>
                    <th class="p-3 border border-gray-400">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bg-gray-100 text-black'>";
                        echo "<td class='p-3 border border-gray-400'>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td class='p-3 border border-gray-400'>
                                <img src='" . htmlspecialchars($row["image"]) . "' class='w-20 h-20 object-cover rounded-lg'>
                              </td>";
                        echo "<td class='p-3 border border-gray-400 flex'>";
                        echo "<a href='admin_dashboard.php?approve=" . $row["id"] . "' class='bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 mr-2'>Approve</a>";
                        echo "<a href='admin_dashboard.php?delete=" . $row["id"] . "' class='bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600'>Delete</a>";
                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='p-3 text-center'>No pending recipes.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
