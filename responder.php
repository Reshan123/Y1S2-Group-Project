<?php
require "DatabaseConnect.php";
$url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// echo $url;
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
        <div class="leftAlign" id="supportLogo" onclick="showRegTickets()">
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
                $ResponderID = $_GET["responderid"];
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
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["RegT_title"] . "</div><br/><div class=" . "body" . ">" . $row["RegT_body"] . "</div><br/><button class=" . "button" . " onclick=" . "reply(" . $row["RegT_ID"] . ")" . ">Reply</button>";

            // Retrieve the username of the user who added the ticket.
            $resultStuID = $conn->query("SELECT * FROM registered_user WHERE Reg_ID = " . $row["Reg_ID"]);
            while ($row = $resultStuID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Reg_username"] . "</div> </div>";
            }
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
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["UnregT_title"] . "</div><br/><div class=" . "body" . ">" . $row["UnregT_body"] . "</div><br/><br/><form action = mailto:".$row["UnregT_pemail"]."><button type="."submit"." class=" . "button".")" . ">Reply</button></form>";
            echo "<div class=" . "addedBy" . ">Added by :- " . $row["UnregT_pemail"] . "</div></div>";
        }
        ?>
    </div>

    <!-- Common Questions -->
    <div class="common_q" id="commonQ">
        <?php
        // Retrieve all common questions from the database.
        $sqlCommonQ = "SELECT * FROM common_q";
        $resultCommonQ = $conn->query($sqlCommonQ);
        while ($row = $resultCommonQ->fetch_assoc()) {
            // Display each common question.
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

            // Retrieve the username of the Responder who added the question.
            $resultResponderID = $conn->query("SELECT * FROM responder WHERE Responder_ID = " . $row["Responder_ID"]);
            while ($row = $resultResponderID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Responder_username"] . "</div></div>";
            }
        }
        ?>

        <!-- Ayathma Form -->
    </div>

    <!-- Reply Section -->
    <div class="reply" id="reply">
        <?php
        // If a ticket ID is set in the URL, display the reply section.
        if (isset($_GET["ID"])) {
            $ID = $_GET["ID"];
            $resultGetSolution = $conn->query("SELECT * FROM solution WHERE RegT_ID =" . $ID);

            // If a solution has already been added for this ticket, display an alert.
            while ($row = $resultGetSolution->fetch_assoc()) {
                echo '<script>';
                echo 'alert("Already answered");';
                echo 'document.getElementById("reply").style.display = "block";';
                echo 'document.getElementById("registered_tickets").style.display = "block";';
                echo '</script>';
            }

            // If a solution has not been added for this ticket, display the reply form.
            if ($resultGetSolution->num_rows == 0) {
                $resultTicket = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $ID);
                while ($row = $resultTicket->fetch_assoc()) {
                    echo "<h1 class=" . "title" . ">" . $row["RegT_title"] . "</h1>";
                    $resultTicketBody = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $ID);
                    while ($row = $resultTicketBody->fetch_assoc()) {
                        echo "<div class=" . "body" . ">" . $row["RegT_body"] . "</div>";
                    }
                    echo "<form action=$url method=" . "post" . ">
                            <div class=" . "solution" . ">Solution : <textarea name=" . "solution" . " cols=" . "100" . " rows=" . "10" . " style=" . "padding:15px;" . "></textarea></div>
                            <button type=" . "submit" . " name=" . "solutionsubmit" . " class=" . "button" . ">Submit</button>
                        </form>";
                }
            }
        }
        ?>
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

<?php
// If the solution form is submitted, add the solution to the database.
if (isset($_POST["solutionsubmit"])) {
    // Retrieve the highest solution ID from the database.
    $resultSID = $conn->query("SELECT S_ID FROM solution");
    $sid = 0;
    while ($row = $resultSID->fetch_assoc()) {
        if ($sid < $row["S_ID"]) {
            $sid = $row["S_ID"];
        }
    }
    $sid++;
    $solutionText = $_POST["solution"];

    // Insert the solution into the database.
    $sqlInsertSolution = "INSERT INTO solution (S_ID,S_Body,RegT_ID,Res_ID) VALUES ($sid,'$solutionText' , $ID , $ResponderID)";

    if ($conn->query($sqlInsertSolution) === TRUE) {
        echo '<script>';
        echo 'alert("Solution Added");';
        echo 'document.getElementById("reply").style.display = "block";';
        echo 'document.getElementById("registered_tickets").style.display = "block";';
        echo '</script>';
    }

}
?>