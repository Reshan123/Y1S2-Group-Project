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
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Manager</p>
        </div>
        <div class="rightAlign">
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

        } else if (isset($_GET["DeleteID"])) {

        }
        ?>

        <form action="manageresponder.php" method="post">
            Name : <input type="text" name="name" id="name"><br>
            Email : <input type="text" name="email" id="email"><br>
            Password : <input type="text" name="pwd" id="pwd">
        </form>
    </div>



</body>

</html>