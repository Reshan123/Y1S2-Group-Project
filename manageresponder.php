<?php
require "DatabaseConnect.php";

if (isset($_COOKIE["ManID"])) {
    $managerID = $_COOKIE["ManID"];
} else {
    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/manageresponder.css" />
    <link rel="stylesheet" href="css/navigationBar.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/cornell (1).png" alt="LOGO" />
            <p>Support Page > Manager</p>
        </div>
        <div class="rightAlign">
            <p class="button" onclick="goHome()">Home</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php
                $sqlManagerName = "SELECT * FROM manager WHERE Man_ID='$managerID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Man_username"];
                }
                ?>
            </p>
        </div>
    </nav>


    <div class="update">
        <?php
        if (isset($_GET["UpdateID"])) {

            $updateID = $_GET["UpdateID"];
            setcookie("updateID", $updateID, time() + 3600, "/");

            $resultResponderDetails = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $updateID);

            while ($row = $resultResponderDetails->fetch_assoc()) {
                echo "<fieldset>
                        <legend>Update responder</legend>
                        <form action=manageresponder.php method=post>
                            <p>Name</p>  <input type=text name=name id=name value=" . $row["Res_username"] . "><br>
                            <p>Email</p>  <input type=text name=email id=email value=" . $row["Res_email"] . "><br>
                            <p>Password</p>  <input type=text name=pwd id=pwd value=" . $row["Res_password"] . "><br>
                            <button class=button name=update>Update</button>
                        </form>
                    </fieldset>";
            }
        } else if (isset($_GET["DeleteID"])) {

            $deleteID = $_GET["DeleteID"];
            $resultDelete = $conn->query("DELETE FROM responder WHERE Res_ID=" . $deleteID);

            if ($resultDelete) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }

        } else {
            echo "<fieldset>
                        <legend>Add responder</legend>
                        <form action=manageresponder.php method=post>
                            <p>Name</p>  <input type=text name=nameAdd id=name><br>
                            <p>Email</p>  <input type=text name=emailAdd id=email><br>
                            <p>Password</p>  <input type=text name=pwdAdd id=pwd><br>
                            <button class=button name=add>Update</button>
                        </form>
                    </fieldset>";
        }


        if (isset($_POST["update"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $updateCookie = $_COOKIE["updateID"];

            $resultUpdateRecord = $conn->query("UPDATE responder SET Res_username='$name' , Res_email='$email' , Res_password='$pwd' WHERE Res_ID=$updateCookie");

            if ($resultUpdateRecord) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }
        }

        if (isset($_POST["add"])) {
            $nameAdd = $_POST["nameAdd"];
            $emailAdd = $_POST["emailAdd"];
            $pwdAdd = $_POST["pwdAdd"];
            $managerID = $_COOKIE["ManID"];
            $IDAdd = 0;
            $resultHighestID = $conn->query("SELECT * FROM responder");

            while ($row = $resultHighestID->fetch_assoc()) {
                if ($IDAdd < $row["Res_ID"]) {
                    $IDAdd = $row["Res_ID"];
                }
            }
            $IDAdd++;

            $resultInsert = $conn->query("INSERT INTO responder(Res_ID,Res_username,Res_email,Res_password,Man_ID) VALUES ($IDAdd,'$nameAdd','$emailAdd','$pwdAdd',$managerID)");
            if ($resultInsert) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }
        }
        ?>


    </div>

    <script>
        function goHome() {
            document.location = "http://localhost/Y1S2-Group-Project/manager.php";
            document.cookie = "updateCookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    </script>

</body>

</html>