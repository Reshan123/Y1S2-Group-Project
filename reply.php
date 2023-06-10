<?php
require "DatabaseConnect.php";
session_start();
?>
<html>

<head>
    <title>Document</title>
    <link rel="stylesheet" href="css/reply.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

</html>

<body>
<nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo" />
        <p class="supportTxt">Admin Panel</p>
        <p class="button" onclick="showRegTickets()">Home</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon" />
        <button class="logout" onclick="logout()">Logout</button>

        <p id="logInStatus" class="logInStatus">
            <?php
            // Get the Responder ID from the URL.
            if (isset($_COOKIE["ResID"])) {
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


    <script>
        function showRegTickets() {
            window.location = "http://localhost/Y1S2-Group-Project/responder.php";
        }
    </script>

    <!-- Reply Section -->
    <div class="reply" id="reply">
        <?php
        // If a ticket ID is set in the URL, display the reply section.
        
        if (!$_SESSION["RegID"] == "") {
            $ID = $_SESSION["RegID"];
            $resultGetSolution = $conn->query("SELECT * FROM solution WHERE RegT_ID =" . $ID);


            // If a solution has not been added for this ticket, display the reply form.
            if ($resultGetSolution->num_rows == 0) {
                $resultTicket = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $ID);
                while ($row = $resultTicket->fetch_assoc()) {
                    echo "<h1 class=" . "title" . ">" . $row["RegT_title"] . "</h1>";
                    echo "<div class=" . "body" . ">" . $row["RegT_body"] . "</div>";
                    echo "<form action=reply.php method=" . "post" . ">
                            <div class=" . "solution" . ">Solution : <textarea name=" . "solution" . " cols=" . "100" . " rows=" . "10" . " style=" . "padding:15px;" . "></textarea></div>
                            <button type=" . "submit" . " name=" . "solutionsubmit" . " class=" . "button" . ">Submit</button>
                        </form>";
                }
            }
        } else if (!$_SESSION["SolID"] == "") {
            $solID = $_SESSION["SolID"];
            $resultSolution = $conn->query("SELECT * FROM solution WHERE RegT_ID =" . $solID);
            $resultTicket = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $solID);
            while ($row = $resultTicket->fetch_assoc()) {
                while ($rowSol = $resultSolution->fetch_assoc()) {
                    echo "<h1 class=" . "title" . ">" . $row["RegT_title"] . "</h1>";
                    echo "<div class=" . "body" . ">" . $row["RegT_body"] . "</div>";
                    echo "<form action=reply.php method=" . "post" . ">
                            <div class=" . "solution" . ">Solution : <textarea name=" . "solutionupdatetext" . " cols=" . "100" . " rows=" . "10" . " style=" . "padding:15px; >" . $rowSol['S_Body'] . "</textarea></div>
                            <button type=" . "submit" . " name=" . "solutionupdate" . " class=" . "button" . ">Submit</button>
                        </form>";
                }
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
    $ID = $_SESSION["RegID"];
    // Insert the solution into the database.
    $sqlInsertSolution = "INSERT INTO solution (S_ID,S_Body,RegT_ID,Res_ID) VALUES ($sid,'$solutionText' , $ID , $ResponderID)";

    if ($conn->query($sqlInsertSolution) === TRUE) {
        $_SESSION["RegID"] = "";
        $_SESSION["SolID"] = "";
        header("location:http://localhost/Y1S2-Group-Project/responder.php");
    }

} else if (isset($_POST["solutionupdate"])){
    $ResponderID = $_COOKIE["ResID"];
    $solID = $_SESSION["SolID"];
    $solutionupdatetext = $_POST["solutionupdatetext"];

    $sqlSolutionUpdate = $conn->query("UPDATE solution SET S_Body = '$solutionupdatetext' , Res_ID = $ResponderID WHERE RegT_ID = $solID");

    if ($sqlSolutionUpdate === TRUE) {
        $_SESSION["RegID"] = "";
        $_SESSION["SolID"] = "";
        header("location:http://localhost/Y1S2-Group-Project/responder.php");
        
    }
}
?>