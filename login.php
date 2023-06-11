<?php
require "DatabaseConnect.php"; //database connection file

//check if ID cookie is set
if (isset($_COOKIE["ID"])) {

    if ($_COOKIE["ID"] == "unreg") { // if cookie value is equl to unreg

        header('location: unregistered.php');
    } else if (is_numeric($_COOKIE["ID"])) { // if cookie value is numeric

        header('location:registered.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Login</title>
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
                            Email : <input type="email" name="email" id="emailInput" required>
                        </div>
                        <div>
                            Password : <input type="password" name="password" id="PwdInput" required>
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


if (isset($_POST["Submit"]) && !isset($_POST["Type"])) { // if form is submitted and user type not selected
    // alert a message
    echo "<script>alert('Enter a user type');</script>";

} else if (isset($_POST["Submit"]) && isset($_POST["Type"])) {  // if form is submitted and user type is selected
    // assign the form value to variables
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

        } else { //if records not matching with database
            echo "<script>alert('Enter valid credentials');</script>";
        }
    }
}
?>