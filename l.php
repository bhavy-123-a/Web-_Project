<?php
$username = $_POST['username'];
$password = $_POST['password'];

$con = new mysqli("localhost", "root", "", "signup");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM signin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        // Use password_verify to compare hashed password
        if (password_verify($password, $data['password'])) {
            echo "<h2>Login Successfully</h2>";
        } else {
            echo "<h2>Login Successfully</h2>";
        }
    } else {
        echo "<script>alert('Invalid username or password!')</script>";
    }
}
?>
