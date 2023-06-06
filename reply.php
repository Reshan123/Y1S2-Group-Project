<?php
require "DatabaseConnect.php";
session_start();
?>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/reply.css">
    <link rel="stylesheet" href="css/navigationBar.css">
</head>

</html>

<body>
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Staff</p>
        </div>
        <div class="rightAlign">
            <p class="button" onclick="showRegTickets()">Registered Tickets</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php
                // Get the Responder ID from the URL.
                $ResponderID = $_COOKIE["ResID"];
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


<script>
    function showRegTickets() {
        window.location = "http://localhost/Y1S2-Group-Project/responder.php";
    }
</script>

    <!-- Reply Section -->
    <div class="reply" id="reply">
        <?php
        // If a ticket ID is set in the URL, display the reply section.
        
            $ID = $_SESSION["RegID"];
            $resultGetSolution = $conn->query("SELECT * FROM solution WHERE RegT_ID =" . $ID);

            // If a solution has already been added for this ticket, display an alert.
            while ($row = $resultGetSolution->fetch_assoc()) {
                echo '<script>';
                echo 'alert("Already answered");';
                echo 'document.getElementById("reply").style.display = "block";';
                echo 'document.getElementById("registered_tickets").style.display = "block";';
                echo '</script>';
                header("location:http://localhost/Y1S2-Group-Project/responder.php");
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
                    echo "<form action=reply.php method=" . "post" . ">
                            <div class=" . "solution" . ">Solution : <textarea name=" . "solution" . " cols=" . "100" . " rows=" . "10" . " style=" . "padding:15px;" . "></textarea></div>
                            <button type=" . "submit" . " name=" . "solutionsubmit" . " class=" . "button" . ">Submit</button>
                        </form>";
                }
            }
        

        ?>
    </div>
</body>



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
        header("location:http://localhost/Y1S2-Group-Project/responder.php");
    }

}
?>
