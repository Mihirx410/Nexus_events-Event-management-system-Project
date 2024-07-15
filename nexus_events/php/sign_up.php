<?php
session_start();

function redirect($message, $location) {
    echo "<script>alert('$message');</script>";
    echo "<script>window.location.href = '$location';</script>";
    exit();
}

function checkLoggedIn() {
    if (isset($_SESSION['isAdmin'])) {
        redirect('Admin logged in. Redirecting to admin dashboard...', '../admin_dash/dashboard.php');
    } elseif (isset($_SESSION['isGeneral'])) {
        redirect('User logged in. Redirecting to index page...', '../index.php');
    } else {
        redirect('Not logged in. Redirecting to login page...', '../Authentication/login.html');
    }
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $uemail = $_POST['email'];
    $upassword = $_POST['password'];

    // Database connection
    $db_conn = mysqli_connect("localhost", "root", "", "nexus_events");

    if ($db_conn === false) {
        die("ERROR: could not connect" . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($db_conn, $name);
    $username = mysqli_real_escape_string($db_conn, $username);
    $phoneNumber = mysqli_real_escape_string($db_conn, $phoneNumber);
    $email = mysqli_real_escape_string($db_conn, $uemail);
    $password = mysqli_real_escape_string($db_conn, $upassword);

    // Query to insert user data
    $insert_query = "INSERT INTO sign_up (name, username, phone_number, email, password) VALUES ('$name', '$username', '$phoneNumber', '$email', '$password')";
    $insert_users = "INSERT INTO admin_user_details (name, email,password) VALUES ('$name','$email','$password')";
    $admin_user = mysqli_query($db_conn, $insert_users);

    
    if (mysqli_query($db_conn, $insert_query)) {
        // Automatically log in the user after registration
        $_SESSION['isGeneral'] = true;
        $user_data = array(
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'phone_number' => $phoneNumber
        );
        $_SESSION['userData'] = json_encode($user_data);
        redirect('Registration successful! You are now logged in.', '../index.php');
    } else {
        echo "<script>alert('Error: " . mysqli_error($db_conn) . "');</script>";
    }

    mysqli_close($db_conn);
}

checkLoggedIn(); // Check if the user is logged in before allowing access to the page
?>