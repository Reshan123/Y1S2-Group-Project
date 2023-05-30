<?php
require "DatabaseConnect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/responder1.css" />
    <link rel="stylesheet" href="css/navigationBar.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Staff</p>
        </div>
        <div class="rightAlign">
            <p class="raiseTicket" id="raiseTicket">Common Questions</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php $ResponderID = $_GET["responderid"];
                $sqlManagerName = "SELECT * FROM responder WHERE Responder_ID='$ResponderID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Responder_username"];
                }
                ?>
            </p>
        </div>
    </nav>

    <div class="common_q">
        <?php
        $sqlCommonQ = "SELECT * FROM common_q";
        $resultCommonQ = $conn->query($sqlCommonQ);
        while ($row = $resultCommonQ->fetch_assoc()) {
            echo "<div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

            $resultResponderID = $conn->query("SELECT * FROM responder WHERE Responder_ID = " . $row["Responder_ID"]);
            while ($row = $resultResponderID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Responder_username"] . "</div>";
            }
        }
        ?>
    </div>

    <script src="js/responder.js"></script>
</body>

</html>