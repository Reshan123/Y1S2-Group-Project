<?php
require "DatabaseConnect.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/responder.css" />
    <link rel="stylesheet" href="css/navigationBar.css">
    <title>Document</title>
</head>

<body>

    <!-- Navigation bar -->
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Staff</p>
        </div>
        <div class="rightAlign">
            <p class="button" onclick="showRegTickets()">Registered Tickets</p>
            <p class="button" onclick="showUnregTickets()">Unregistered Tickets</p>
            <p class="button" onclick="showCommonQ()">Common Questions</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php
                // Get the Responder ID from the URL.
                if (isset($_COOKIE["ResID"])){
                    $ResponderID = $_COOKIE["ResID"];
                } else {
                    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
                }
                
                // Retrieve the username of the Responder from the database.
                $sqlManagerName = "SELECT * FROM responder WHERE Res_ID='$ResponderID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Res_username"];
                }
                ?>
            </p>
        </div>
    </nav>

    <!-- Registered Tickets -->
    <div class="registered_tickets" id="registered_tickets">
        <h1>Registered Tickets</h1>
        <?php
        // Retrieve all registered tickets from the database.
        $sqlRegT = "SELECT * FROM reg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            // Display each registered ticket.
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["RegT_title"] . "</div><br/><div class=" . "body" . ">" . $row["RegT_body"] . "</div><br/>";
            $sqlReplyCheck = $conn->query("SELECT * FROM solution WHERE RegT_ID=". $row["RegT_ID"]);
            if ($sqlReplyCheck->num_rows == 0){
                echo "<form action=responder.php method=post><input name=regid value=".$row["RegT_ID"]."><button class=button name=reply>Reply</button></form>";
            } else {
                echo "<button class=button>Already Replied</button>";
            }
            // Retrieve the username of the user who added the ticket.
            $resultStuID = $conn->query("SELECT * FROM registered_user WHERE Reg_ID = " . $row["Reg_ID"]);
            while ($row = $resultStuID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Reg_username"] . "</div> </div>";
            }
        }

        if(isset($_POST["reply"])){
            $_SESSION["RegID"] = $_POST["regid"];
            header("location:http://localhost/Y1S2-Group-Project/reply.php");
        }
        ?>
    </div>

    <!-- Unregistered Tickets -->
    <div class="unreg_tickets" id="unreg_tickets">
        <h1>Unregistered Tickets</h1>
        <?php
        // Retrieve all unregistered tickets from the database.
        $sqlRegT = "SELECT * FROM unreg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            // Display each unregistered ticket.
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["UnregT_title"] . "</div><br/><div class=" . "body" . ">" . $row["UnregT_body"] . "</div><br/><br/><form action = mailto:" . $row["UnregT_pemail"] . "><button type=" . "submit" . " class=" . "button" . ")" . ">Reply</button></form>";
            echo "<div class=" . "addedBy" . ">Added by :- " . $row["UnregT_pemail"] . "</div></div>";
        }
        ?>
    </div>

    <!-- Common Questions -->
    <div class="common_q" id="commonQ">
        <h1>Common Questions</h1>
        <?php
        $sqlCommonQ = "SELECT * FROM common_q";
        $resultCommonQ = $conn->query($sqlCommonQ);
        while ($row = $resultCommonQ->fetch_assoc()) {
            echo "<div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

            $resultResponderID = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $row["Res_ID"]);
            while ($row = $resultResponderID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Res_username"] . "</div>";
            }
        }
        ?>
        <p class="button">Add common questions</p>  
    </div>

    <?php
    // If a ticket ID is set in the URL, display the reply section.
    if (isset($_GET["ID"])) {
        echo '<script>let reply_ID = document.getElementById("reply");
        let commonQ_ID = document.getElementById("commonQ");
        let registered_tickets_ID = document.getElementById("registered_tickets");
        let unreg_tickets_ID = document.getElementById("unreg_tickets");
        commonQ_ID.style.display = "none";
        registered_tickets_ID.style.display = "none";
        unreg_tickets_ID.style.display = "none";
        reply_ID.style.display = "block";</script>';
    }
    ?>

    <script src="js/responder.js"></script>
</body>

</html>