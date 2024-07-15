<?php
session_start(); // Start the session at the beginning of your PHP code

function checkLoggedIn() {
    if (isset($_SESSION['isAdmin'])) {
        echo "<script>alert('Admin logged in. Redirecting to admin dashboard...')</script>";
        // header("Location: ../admin_dash/dashboard.php"); // Redirect to admin dashboard
        echo "<script>window.location.href = '../admin_dash/dashboard.php';</script>";
        exit();
    } elseif (isset($_SESSION['isGeneral'])) {
        echo "<script>alert('User logged in. Redirecting to home page...')</script>";
        echo "<script>window.location.href = '../index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Not logged in. Redirecting to login page...');</script>";
        echo "<script>window.location.href = '../Authentication/login.html';</script>";
        exit();
    }
}
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $db_conn = mysqli_connect("localhost", "root", "", "nexus_events");
    if ($db_conn === false) {
        die("ERROR: could not connect" . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($db_conn, $email);
    $password = mysqli_real_escape_string($db_conn, $password);

    // Query for admin login
    $admin_query = "SELECT id, name, username, email, phone_number, login_date FROM admin WHERE (username= '$email' OR email='$email') AND password='$password'";
    $admin_result = mysqli_query($db_conn, $admin_query);

    // Query for general user login
    $user_query = "SELECT ID, name, username, email, phone_number, login_date FROM sign_up WHERE (username= '$email' OR email='$email') AND password='$password'";
    $user_result = mysqli_query($db_conn, $user_query);

    if (mysqli_num_rows($admin_result) > 0) {
        $user_data = mysqli_fetch_assoc($admin_result);
        $_SESSION['isAdmin'] = true;
        $_SESSION['userData'] = json_encode($user_data);
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id();
        // Check if the user is logged in before allowing access to the page
        checkLoggedIn();
    } elseif(mysqli_num_rows($user_result) > 0) {
        $user_data = mysqli_fetch_assoc($user_result);
        $_SESSION['isGeneral'] = true;
        $_SESSION['userData'] = json_encode($user_data);
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id();
        // Check if the user is logged in before allowing access to the page
        checkLoggedIn();
    } else {
        checkLoggedIn();
        // No need to call checkLoggedIn() here
    }

    mysqli_close($db_conn);
}
?>
