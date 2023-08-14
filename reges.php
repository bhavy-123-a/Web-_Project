<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$num = $_POST['num'];

if (!empty($username) || !empty($password) || !empty($email) || !empty($num)) {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "signup";
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email from signup where email = ? Limit 1";
        $INSERT = "INSERT Into signup (username, password, email, num) values (?, ?, ?, ?)";
        
        // Prepare and bind the SELECT query
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            // Prepare and bind the INSERT query
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $username, $password, $email, $num);
            $stmt->execute();
            echo "New record inserted successfully";
        } else {
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "ALL fields are required";
    die();
}
?>
