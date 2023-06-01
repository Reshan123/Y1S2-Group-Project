<?php

require "DatabaseConnect.php"
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navigationBar.css">

</head>

<body>
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
        <form action="adminlogin.php" method="post" class="form">

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

    <script src="js/adminlogin.js"></script>
</body>

</html>

<?php
$email = "";
$password = "";
$type = "";
if (isset($_POST["Submit"]) and isset($_POST["Type"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];
    if ($type == "Manager") {
        $sql = "SELECT * FROM manager WHERE Manager_email='$email' AND Manager_password='$password';";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            header("location:http://localhost/Y1S2-Group-Project/manager.php?managerid=" . $row["Manager_ID"]);
        }
    } else if ($type == "Staff") {
        $sql = "SELECT * FROM responder WHERE Res_email='$email' AND Res_password='$password';";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            header("location:http://localhost/Y1S2-Group-Project/responder.php?responderid=" . $row["Res_ID"]);
        }
    } else {
        echo "<script> alert('Please enter a user type!!'); </script>";
    }
}




?>