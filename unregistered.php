<?php
require "DatabaseConnect.php";
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/unregistered.css" />
    <link rel="stylesheet" href="css/navigationBar.css" />
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" onclick="showCommonQ()">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Unregistered</p>

        </div>
        <div class="rightAlign">
            <p class="button" onclick="showRaiseT()">Raise Ticket</p>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">Unregistered User</p>
        </div>
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
        ?>
    </div>

    <script src="js/unreg.js"></script>
</body>

</html>

<?php
if (isset($_POST["Submit"])) {
    $t_title = $_POST["T_title"];
    $t_pemail = $_POST["T_pemail"];
    $t_body = $_POST["T_body"];

    $resultUnregTID = $conn->query("SELECT UnregT_ID FROM unreg_tickets");
    $UnregTID = 0;
    while ($row = $resultUnregTID->fetch_assoc()) {
        if ($UnregTID < $row["UnregT_ID"]) {
            $UnregTID = $row["UnregT_ID"];
        }
    }
    $UnregTID++;

    $sqlInsertUnregT = "INSERT INTO unreg_tickets (UnregT_ID,UnregT_title, UnregT_body, UnregT_pemail) VALUES ($UnregTID,'$t_title','$t_body','$t_pemail')";

    if ($conn->query($sqlInsertUnregT) == TRUE) {
        echo "<script> alert('Your ticket has been raised. Please await for reply through $t_pemail.' ) </script>";
    }
}

?>