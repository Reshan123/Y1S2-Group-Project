<?php
require "DatabaseConnect.php";
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/registered.css" />
    <link rel="stylesheet" href="css/navigationBar.css" />
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" onclick="showCommonQ()">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Registered</p>

        </div>
        <div class="rightAlign">
            <p class="button" onclick="showRaiseT()">Raise Ticket</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php
                    // Get the User ID from the URL.
                    $RegID = $_GET["regid"];
                    // Retrieve the username of the User from the database.
                    $resultUsersName = $conn->query("SELECT * FROM registered_user WHERE Reg_ID='$RegID'");
                    while ($row = $resultUsersName->fetch_assoc()) {
                        echo $row["Reg_username"];
                }
                ?>
            </p>
        </div>
    </nav>

    <div class="askedQ">

    </div>



    <script src="js/registered.js"></script>
</body>

</html>