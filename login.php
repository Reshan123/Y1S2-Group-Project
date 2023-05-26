<?php
include "navBar.php";
require "DatabaseConnect.php"
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <center style="padding:100px 0px;">
        <form action="login.php" method="post" class="form">

            <div class="userType">
                <div>
                    <input type="radio" name="Type" id="Unregistered" value="Unregistered">
                    <p id="UnregisteredText">Unregistered</p>
                </div>
                <div>
                    <input type="radio" name="Type" id="Registered" value="Registered">
                    <p id="RegisteredText">Registered student</p>
                </div>
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

    <script src="js/login.js"></script>
</body>

</html>

<?php
$email = "";
$password = "";
$type = "";
if (isset($_POST["Submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $type = $_POST["Type"];
    if ($type == "Unregistered" && $email == "" && $password == ""){
        echo "Unregistered";
    } else if ($type == "Registered") {
        $sql = "SELECT StudentEmail , StudentPassword FROM studentdetails WHERE StudentEmail = '$email' AND StudentPassword = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            echo "Registered";
        } else {
            echo "NOOO Registered";
        }
    } else if ($type == "Manager") {
        $sql = "SELECT 'ManagerEmail','ManagerPassword' FROM managerdetails WHERE ManagerEmail='$email' AND ManagerPassword='$password';";
        $result = $conn->query($sql);

        if ($result){
            if ($result->num_rows == 1) {
                echo "Manager";
            } else {
                echo "NOOO Manager";
            }
        } else {
            echo "Error in ".$query."<br>".$conn->error;
        }
    }
}




?>