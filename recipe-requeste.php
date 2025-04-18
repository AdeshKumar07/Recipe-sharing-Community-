<?php
session_start();

$conn = new mysqli("localhost", "root", "", "recepie");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, name, ingredients, instructions, status FROM user_recipes WHERE status = 'pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Requested Recipes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Pending Recipe Requests</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Recipe Name</th>
                            <th class="py-3 px-4 text-left">Ingredients</th>
                            <th class="py-3 px-4 text-left">Instructions</th>
                            <th class="py-3 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-3 px-4"><?= htmlspecialchars($row['id']) ?></td>
                                <td class="py-3 px-4 font-medium"><?= htmlspecialchars($row['name']) ?></td>
                                <td class="py-3 px-4 whitespace-pre-line"><?= htmlspecialchars($row['ingredients']) ?></td>
                                <td class="py-3 px-4 whitespace-pre-line"><?= htmlspecialchars($row['instructions']) ?></td>
                                <td class="py-3 px-4 text-yellow-600 font-semibold"><?= htmlspecialchars($row['status']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">No pending recipe requests found.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
</body>
</html>
