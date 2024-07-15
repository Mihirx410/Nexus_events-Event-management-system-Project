    <?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "nexus_events";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch users from the database
function getUsers($conn) {
    $sql = "SELECT id, name, email, password FROM sign_up";
    $result = $conn->query($sql);
    $users = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

// Handle delete user action
if(isset($_POST['delete_user'])){
    $id = $_POST['user_id'];

    // SQL query to delete user
    $delete_query1 = "DELETE FROM sign_up WHERE id = $id";
    $delete_query2 = "DELETE FROM admin_user_details WHERE id = $id";

    // Execute the delete query
    if((mysqli_query($conn, $delete_query1)) && (mysqli_query($conn, $delete_query2))) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
    }
//function to insert users
function insertAdminUser($conn, $id, $name, $email, $password) {
    $insert_query = "INSERT INTO admin_user_details (id, name, email, password) VALUES ('$id', '$name', '$email','$password')";
    // if(mysqli_query($conn, $insert_query)) {
    //     // echo "<script>alert('User added to admin_users table successfully');</script>";
    // } else {
    //     // echo "<script>alert('Error adding user to admin_users table: " . mysqli_error($conn) . "');</script>";
    }


// Fetch users from sign_up table
$users = getUsers($conn);

// Insert each user into admin_user_details table
foreach($users as $user) {
    insertAdminUser($conn, $user['id'], $user['name'], $user['email'], $user['password']);
}

?>
<html>
    <body>
        <head>
            <h3>User Details</h3>                    
            <link rel="stylesheet" href="style.css">
            <script>
                function confirmAction(action) {
                    return confirm("Are you sure you want to " + action + "?");
                }
            </script>
        </head>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['password']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmAction('delete this user')">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
