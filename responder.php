<?php
require "DatabaseConnect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/responder.css" />
    <link rel="stylesheet" href="css/navigationBar.css">
    <title>Document</title>
</head>

<body>

    <nav>
        <div class="leftAlign" id="supportLogo" onclick="showRegTickets()">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Staff</p>
        </div>
        <div class="rightAlign">
            <p class="button" onclick="showUnregTickets()">Unregistered Tickets</p>
            <p class="button" onclick="showCommonQ()">Common Questions</p>
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


    <div class="registered_tickets" id="registered_tickets">
        <?php
        $sqlRegT = "SELECT * FROM reg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            echo "<div class=" . "title" . ">" . $row["RegT_Title"] . "</div><br/><div class=" . "body" . ">" . $row["RegT_body"] . "</div><br/>";

            $resultStuID = $conn->query("SELECT * FROM registered_user WHERE R_ID = " . $row["R_ID"]);
            while ($row = $resultStuID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["R_username"] . "</div>";
            }
        }
        ?>
    </div>

    <div class="unreg_tickets" id="unreg_tickets">
        <?php
        $sqlRegT = "SELECT * FROM unreg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            echo "<div class=" . "title" . ">" . $row["UnregT_title"] . "</div><br/><div class=" . "body" . ">" . $row["UnregT_body"] . "</div><br/>";
            echo "<div class=" . "addedBy" . ">Added by :- " . $row["UnregP_email"] . "</div>";
        }
        ?>
    </div>

    <div class="common_q" id="commonQ">
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


        // AYATHMA FORM
        ?>
    </div>

    <script src="js/responder1.js"></script>
</body>

</html>