<?php
session_start();


$conn = new mysqli("localhost", "root", "", "recepie");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); 
$contact = trim($_POST['contact']);
$birthdate = $_POST['birthdate'];


$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "<script>alert('Email already registered! Please login.'); window.location.href='login.php';</script>";
    $check->close();
    $conn->close();
    exit();
}
$check->close();


$stmt = $conn->prepare("INSERT INTO users (name, email, password, contact, birthdate) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $password, $contact, $birthdate);

if ($stmt->execute()) {
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;

    
    header("Location: index.php");
    exit();
} else {
    
    echo "<script>alert('Something went wrong while registering. Please try again later.'); window.location.href='register.php';</script>";
}

$stmt->close();
$conn->close();
?>
