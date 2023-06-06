<?php
require "DatabaseConnect.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navigationBar.css">

</head>

<body>
    <!-- Navigation bar -->
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page</p>
        </div>
        <div class="rightAlign">
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
            </div>
            <p id="logInStatus">Not Logged In</p>
        </div>
    </nav>

    <center style="padding:100px 0px;">
        <!-- Admin login form -->
        <form action="adminlogin.php" method="post" class="form">



            <fieldset>
                <legend>Log in</legend>
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

    <script src="js/adminlogin.js"></script>
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
            setcookie("ManID",  $row["Man_ID"], time() + 3600, "/");
        }
    } else if ($type == "Staff") {
        // Query the database to check if the staff member exists
        $sql = "SELECT * FROM responder WHERE Res_email='$email' AND Res_password='$password';";
        $result = $conn->query($sql);

        // If the staff member exists, redirect to the staff member page with the staff member ID
        while ($row = $result->fetch_assoc()) {
            header("location:http://localhost/Y1S2-Group-Project/responder.php");
            setcookie("ResID", $row["Res_ID"], time() + 3600, "/");
        }
    } else {
        // If user type is not selected, display an error message
        echo "<script> alert('Please enter a user type!!'); </script>";
    }
}
?>