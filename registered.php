<?php
require "DatabaseConnect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/registered.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <title>Document</title>
</head>

<body>
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Support Page</p>
        <p class="button" onclick="goHome()">Home</p>
        <p class="button" onclick="showRaiseT()">Raise Ticket</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <button class="logout" onclick="logout()">Logout</button>
        <p id="logInStatus" class="logInStatus">
            <?php
            // Get the User ID from the URL.
            if (isset($_COOKIE["ID"])) {
                $RegID = $_COOKIE["ID"];
            } else {
                header("location:http://localhost/Y1S2-Group-Project/login.php");
            }
            // Retrieve the username of the User from the database.
            $resultUsersName = $conn->query("SELECT * FROM registered_user WHERE Reg_ID='$RegID'");
            while ($row = $resultUsersName->fetch_assoc()) {
                echo $row["Reg_username"];
            }
            ?>
        </p>
        </div>
    </nav>

    <div class="askedQ" id="askedQ">
        <h1>Raised Questions</h1>
        <div class=hideReply><button class=button onclick=closeAllReply()>Hide Replies</button></div>
        <?php
        echo "<div class=AllTickets>";
        // Retrieve tickets raised by the user
        $resultUserTickets = $conn->query("SELECT * FROM reg_tickets WHERE Reg_ID = " . $RegID);
        if ($resultUserTickets->num_rows > 0) {
            while ($rowTicket = $resultUserTickets->fetch_assoc()) {
                // Check if the ticket has a reply
                $resultTicketReply = $conn->query("SELECT * FROM solution WHERE RegT_ID = " . $rowTicket["RegT_ID"]);
                if ($resultTicketReply->num_rows > 0) {
                    while ($rowReply = $resultTicketReply->fetch_assoc()) {
                        $resultResponder = $conn->query("SELECT * FROM responder WHERE Res_ID=" . $rowReply["Res_ID"]);
                        while ($rowResponder = $resultResponder->fetch_assoc()) {
                            echo "<div class=ticket><div class = title>" . $rowTicket["RegT_title"] . "</div><br>";
                            echo "<div class = body>" . $rowTicket["RegT_body"] . "</div><br>";
                            echo "<button class=button onclick=showSolution(" . $rowReply["S_ID"] . ")>Show Reply</button>";
                            echo "<reply class=reply id=" . $rowReply["S_ID"] . ">" . $rowReply["S_Body"] . " <br><br> Added By:  " . $rowResponder["Res_username"] . "</reply></div>";
                        }

                    }
                } else {
                    echo "<div class=ticket><div class = title>" . $rowTicket["RegT_title"] . "</div><br>";
                    echo "<div class = body>" . $rowTicket["RegT_body"] . "</div><br>";
                    echo "<button class=button id=noReply>Not Replied Yet</button>";
                    echo "</div>";
                }
            }
        } else {
            echo "<h1>You Have Not Raised Any Tickets</h1>";
        }
        ?>
    </div>
    </div>

    <div class="raiseT" id="raiseTForm">
        <form action="registered.php" method="post" class="raiseTForm">
            <fieldset style="border-radius:15px;">
                <legend>Raise Ticket</legend>
                Ticket Title : <br>
                <input type="text" name="T_title" size="40" style="padding:15px;"> <br>
                Select Category:
                <select name="category" id="category">
                    <option value="Scholarship">Scholarship</option>
                    <option value="Repeats">Repeats</option>
                    <option value="ClubsAndSocities">Clubs And Socities</option>
                    <option value="Other">Other</option>
                </select><br>
                <label>Ticket Body :</label> <br>
                <textarea name="T_body" cols="100" rows="10" style="padding:15px;"></textarea> <br>
                <button type="submit" name="Submit" class="submitButton">Raise Ticket</button>
            </fieldset>
        </form>

    </div>

    <script src="js/registered.js"></script>
</body>

</html>