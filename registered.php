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
        <div class="leftAlign" onclick="closeAllReply()">
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

        <?php
        $resultUserTickets = $conn->query("SELECT * FROM reg_tickets WHERE Reg_ID = " . $RegID);
        if ($resultUserTickets->num_rows > 0) {
            echo "<h1>Raised Questions</h1>";
            while ($rowTicket = $resultUserTickets->fetch_assoc()) {
                $resultTicketReply = $conn->query("SELECT * FROM solution WHERE RegT_ID = " . $rowTicket["RegT_ID"]);
                if ($resultTicketReply->num_rows > 0) {
                    while ($rowReply = $resultTicketReply->fetch_assoc()) {

                        echo "<div class=ticket><div class = title>" . $rowTicket["RegT_title"] . "</div><br>";
                        echo "<div class = body>" . $rowTicket["RegT_body"] . "</div><br>";
                        echo "<button class=button onclick=showSolution(" . $rowReply["S_ID"] . ")>Show Reply</button>";
                        echo "<reply class=reply id=" . $rowReply["S_ID"] . ">" . $rowReply["S_Body"] . "</reply></div>";
                    }
                } else {
                    echo "<div class=ticket><div class = title>" . $rowTicket["RegT_title"] . "</div><br>";
                    echo "<div class = body>" . $rowTicket["RegT_body"] . "</div><br>";
                    echo "<button class=button>Not Replied Yet</button>";
                    echo "</div>";
                }
            }
        } else {
            echo "<h1>You Have Not Raised Any Tickets</h1>";
        }
        ?>
    </div>



    <script src="js/registered.js"></script>
</body>

</html>