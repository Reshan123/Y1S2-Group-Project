<?php
require "DatabaseConnect.php"; // Include the file that connects to the database

?>

<!-- HTML code for the login form and other elements -->
<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
    <!-- Navigation bar -->
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Admin Panel</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <p class="logInStatus" id="logInStatus">Not Logged In</p>
    </nav>

    <center style="padding:50px 0px;">
        <!-- Admin login form -->
        <form action="adminlogin.php" method="post" class="form">
            <fieldset>
                <legend>Log In</legend>
                <!-- User type selection -->
                <div class="userType">
                    <div>
                        <input type="radio" name="Type" id="Staff" value="Staff">
                        <p id="StaffText">Staff</p>
                    </div>
                    <div>
                        <input type="radio" name="Type" id="Manager" value="Manager">
                        <p id="ManagerText">Manager</p>
                    </div>
                </div>
                <!-- Email and password input fields -->
                <div class="mainForm">
                    <div>
                        Email : <input type="text" name="email">
                    </div>
                    <div>
                        Password : <input type="text" name="password">
                    </div>
                    <button type="submit" name="Submit">Submit</button>
                </div>
            </fieldset>
        </form>
    </center>

    <script src="js/adminlogin.js"></script> <!-- Include JavaScript file for admin login form -->

</body>

</html>

<?php
// Initialize variables to store user input
$email = "";
$password = "";
$type = "";

// Check if the admin login form is submitted and user type is selected
if (isset($_POST["Submit"]) and isset($_POST["Type"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];

    // Check if the user is a manager
    if ($type == "Manager") {
        // Query the database to check if the manager exists
        $sql = "SELECT * FROM manager WHERE Man_email='$email' AND Man_password='$password';";
        $result = $conn->query($sql);

        // If the manager exists, redirect to the manager page with the manager ID
        while ($row = $result->fetch_assoc()) {
            header("location:http://localhost/Y1S2-Group-Project/manager.php");
            setcookie("ManID", $row["Man_ID"], time() + 3600, "/"); // Set a cookie with the manager ID
        }
    } else if ($type == "Staff") {
        // Query the database to check if the staff member exists
        $sql = "SELECT * FROM responder WHERE Res_email='$email' AND Res_password='$password';";
        $result = $conn->query($sql);

        // If the staff member exists, redirect to the staff member page with the staff member ID
        while ($row = $result->fetch_assoc()) {
            header("location:http://localhost/Y1S2-Group-Project/responder.php");
            setcookie("ResID", $row["Res_ID"], time() + 3600, "/"); // Set a cookie with the staff member ID
        }
    } else {
        // If user type is not selected, display an error message
        echo "<script> alert('Please enter a user type!!'); </script>";
    }
}
?>