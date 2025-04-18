<?php

$conn = new mysqli("localhost", "root", "", "recepie");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, status, has_calories, has_protein, has_fat, has_carbs 
        FROM recipes 
        WHERE has_calories = 0 OR has_protein = 0 OR has_fat = 0 OR has_carbs = 0";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes Needing Nutritional Info</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-yellow-500 text-center mb-4">Recipes Needing Nutritional Info</h1>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Recipe Name</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Nutritional Info</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="bg-white">
                        <td class="border p-2"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="border p-2">
                            <?php echo $row['status'] == 'approved' ? '✅ Approved' : '❌ Pending'; ?>
                        </td>
                        <td class="border p-2">
                            Calories: <?php echo $row['has_calories'] ? '✅' : '❌'; ?> |
                            Protein: <?php echo $row['has_protein'] ? '✅' : '❌'; ?> |
                            Fat: <?php echo $row['has_fat'] ? '✅' : '❌'; ?> |
                            Carbs: <?php echo $row['has_carbs'] ? '✅' : '❌'; ?>
                        </td>
                        <td class="border p-2">
                            <a href="approve.php?id=<?php echo $row['id']; ?>" 
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Edit Nutrients
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
