<?php
session_start();


$conn = new mysqli("localhost", "root", "", "recepie");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$admin_email = "abhisheksah018@gmail.com";
$admin_password = "abhiisah@17";


$email = trim($_POST['email']);
$password = trim($_POST['password']);
$role = $_POST['role'];


if ($role === "admin") {
    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['user_role'] = 'admin';
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Invalid admin credentials!'); window.location.href='login.php';</script>";
    }
}


elseif ($role === "user") {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = 'user';
        header("Location: index.php"); 
        exit();
    } else {
        echo "<script>alert('Invalid user email or password'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid role selected.'); window.location.href='login.php';</script>";
}

$conn->close();
?>
