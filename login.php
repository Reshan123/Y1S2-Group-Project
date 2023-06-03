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
            <p class="logInStatus" id="logInStatus">Not Logged In</p>
        </div>
    </nav>

    <center style="padding:100px 0px;">
        <!-- Login form -->
        <form action="login.php" method="post" class="form">

            <!-- User type selection -->
            <div class="userType">
                <div>
                    <input type="radio" name="Type" id="Unregistered" value="Unregistered">
                    <p id="UnregisteredText">Unregistered</p>
                </div>
                <div>
                    <input type="radio" name="Type" id="Registered" value="Registered">
                    <p id="RegisteredText">Registered student</p>
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
        </form>
    </center>

    <!-- Login script -->
    <script src="js/login.js"></script>
</body>

</html>

<?php
// Initialize variables to store user input
$email = "";
$password = "";
$type = "";

// Check if the login form is submitted
if (isset($_POST["Submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];

    // Check if the user is unregistered
    if ($type == "Unregistered" && $email == "" && $password == "") {
        header('location:http://localhost/Y1S2-Group-Project/unregistered.php');
    } else if ($type == "Registered") {
        // Check if the user is registered by querying the database
        $sql = "SELECT * FROM registered_user WHERE Reg_email = '$email' AND Reg_password = '$password'";
        $result = $conn->query($sql);

        // If the user is registered
        if ($result->num_rows == 1) {
            while($row = $result->fetch_assoc()){
                header('location:http://localhost/Y1S2-Group-Project/registered.php?regid='.$row["Reg_ID"]);
            }
            
        }
    }
}
?>