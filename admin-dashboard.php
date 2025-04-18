<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recepie");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $conn->query("UPDATE recipes SET status='approved' WHERE id='$id'");
    header("Location: admin_dashboard.php");
    exit();
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM recipes WHERE id='$id'");
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();  
    header("Location: index.php");
    exit();
}


$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

<nav class="bg-yellow-500 p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <a href="?logout=true" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</a>
</nav>

<div class="max-w-5xl mx-auto bg-white text-black shadow-lg rounded-lg p-6 mt-10">
    <h2 class="text-2xl font-bold text-orange-500">Recipe List</h2>
    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-orange-500 text-white">
                <th class="p-3">ID</th>
                <th class="p-3">Name</th>
                <th class="p-3">Status</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $statusClass = ($row['status'] == 'pending') ? 'text-red-500 font-bold' : 'text-green-500 font-bold';
                    echo "<tr class='border-b text-center'>";
                    echo "<td class='p-3'>" . $row['id'] . "</td>";
                    echo "<td class='p-3 font-bold'>" . $row['name'] . "</td>";
                    echo "<td class='p-3 $statusClass'>" . $row['status'] . "</td>";
                    echo "<td class='p-3'>";
                    echo "<a href='?approve=" . $row['id'] . "' class='bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600'>Approve</a> ";
                    echo "<a href='?delete=" . $row['id'] . "' class='bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='p-5 text-center'>No recipes found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
