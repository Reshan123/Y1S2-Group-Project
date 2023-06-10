<?php
require "DatabaseConnect.php"; // Include the file that establishes the database connection.
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/unregistered.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/index.css" />
    <title>Document</title>
</head>

<body>
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Support Page</p>
        <p class="button" onclick="showCommonQ()">Common Questions</p>
        <p class="button" onclick="showRaiseT()">Raise Ticket</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <button class="logout" value="logout" onclick="logout()">Logout</button>
        <p id="logInStatus" class="logInStatus">Unregistered User</p>
    </nav>

    <form action="unregistered.php" method="post" id="raiseTForm" class="raiseTForm">
        <fieldset style="border-radius:15px;">
            <legend>Raise Ticket</legend>
            Ticket Title : <br>
            <input type="text" name="T_title" size="40" style="padding:15px;"> <br>
            Personal Email : <br>
            <input type="text" name="T_pemail" size="40" style="padding:15px;"> <br>
            <label>Ticket Body :</label> <br>
            <textarea name="T_body" cols="100" rows="10" style="padding:15px;"></textarea> <br>
            <button type="submit" name="Submit" class="submitButton">Raise Ticket</button>
        </fieldset>
    </form>


    <div class="common_q">
        <?php
        $sqlCommonQ = "SELECT * FROM common_q";
        $resultCommonQ = $conn->query($sqlCommonQ);

        // Fetch and display common questions from the database
        while ($row = $resultCommonQ->fetch_assoc()) {
            echo "<div class=ticket><div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

            // Fetch and display the responder who added the question
            $resultResponderID = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $row["Res_ID"]);
            while ($row = $resultResponderID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Res_username"] . "</div></div>";
            }
        }
        ?>
    </div>

    <script src="js/unreg.js"></script>
</body>

</html>

<?php
if (isset($_POST["Submit"])) {
    // Get the values from the form submission.
    $t_title = $_POST["T_title"];
    $t_pemail = $_POST["T_pemail"];
    $t_body = $_POST["T_body"];

    // Generate a new UnregT_ID for the new unregistered ticket.
    $resultUnregTID = $conn->query("SELECT UnregT_ID FROM unreg_tickets");
    $UnregTID = 0;
    while ($row = $resultUnregTID->fetch_assoc()) {
        if ($UnregTID < $row["UnregT_ID"]) {
            $UnregTID = $row["UnregT_ID"];
        }
    }
    $UnregTID++;

    // Insert the new unregistered ticket into the database.
    $sqlInsertUnregT = "INSERT INTO unreg_tickets (UnregT_ID,UnregT_title, UnregT_body, UnregT_pemail) VALUES ($UnregTID,'$t_title','$t_body','$t_pemail')";

    if ($conn->query($sqlInsertUnregT) == TRUE) {
        echo "<script> alert('Your ticket has been raised. Please await a reply through $t_pemail.' ) </script>";
    }
}

?>