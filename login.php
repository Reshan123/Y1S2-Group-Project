<?php
require "DatabaseConnect.php";
if (isset($_COOKIE["ID"])) {
    if ($_COOKIE["ID"] == "unreg") {
        header('location:http://localhost/Y1S2-Group-Project/unregistered.php');
    } else if (is_numeric($_COOKIE["ID"])) {
        header('location:http://localhost/Y1S2-Group-Project/registered.php');
    }
}
?>

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
        <p class="supportTxt">Support Page</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <p class="logInStatus" id="logInStatus">Not Logged In</p>
    </nav>

    <center style="padding:50px 0px;">
        <div class="form">
            <fieldset>
                <legend>Log In</legend>
                <!-- Login form -->
                <form action="login.php" method="post">

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
                            Email : <input type="text" name="email" id="emailInput">
                        </div>
                        <div>
                            Password : <input type="text" name="password" id="PwdInput">
                        </div>
                        <button type="submit" name="Submit">Submit</button>
                    </div>
                </form>
            </fieldset>
        </div>
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
if (isset($_POST["Submit"]) && !isset($_POST["Type"])) {

    echo "<script>alert('Enter a user type');</script>";

} else if (isset($_POST["Submit"]) && isset($_POST["Type"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];

    if ($type == "Unregistered" && $email == "Unreg@my.cornwill.us" && $password == "UnregPassword") {
        // Check if the user is unregistered
        header('location:http://localhost/Y1S2-Group-Project/unregistered.php');
        setcookie("ID", "unreg", time() + 3600, "/");
    } else if ($email == "" || $password == "") {
        echo "<script>alert('Please fill all the fields');</script>";
    } else if ($type == "Registered") {
        // Check if the user is registered by querying the database
        $sql = "SELECT * FROM registered_user WHERE Reg_email = '$email' AND Reg_password = '$password'";
        $result = $conn->query($sql);

        // If the user is registered
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                setcookie("ID", $row["Reg_ID"], time() + 3600, "/");
                header('location:http://localhost/Y1S2-Group-Project/registered.php');
            }

        } else {
            echo "<script>alert('Enter valid credentials');</script>";
        }
    }
}
?>