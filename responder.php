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
                $sqlManagerName = "SELECT * FROM responder WHERE Res_ID='$ResponderID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Res_username"];
                }
                ?>
            </p>
        </div>
    </nav>


    <div class="registered_tickets" id="registered_tickets">
        <h1>Registered Tickets</h1>
        <?php
        $sqlRegT = "SELECT * FROM reg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["RegT_title"] . "</div><br/><div class=" . "body" . ">" . $row["RegT_body"] . "</div><br/><button class=" . "button" . " onclick=" . "reply(" . $row["RegT_ID"] . ")" . ">Reply</button>";

            $resultStuID = $conn->query("SELECT * FROM registered_user WHERE Reg_ID = " . $row["Reg_ID"]);
            while ($row = $resultStuID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Reg_username"] . "</div> </div>";
            }
        }
        ?>
    </div>

    <div class="unreg_tickets" id="unreg_tickets">
        <h1>Unregistered Tickets</h1>
        <?php
        $sqlRegT = "SELECT * FROM unreg_tickets";
        $resultRegT = $conn->query($sqlRegT);
        while ($row = $resultRegT->fetch_assoc()) {
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["UnregT_title"] . "</div><br/><div class=" . "body" . ">" . $row["UnregT_body"] . "</div><br/>";
            echo "<div class=" . "addedBy" . ">Added by :- " . $row["UnregT_pemail"] . "</div></div>";
        }
        ?>
    </div>

    <div class="common_q" id="commonQ">
        <?php
        $sqlCommonQ = "SELECT * FROM common_q";
        $resultCommonQ = $conn->query($sqlCommonQ);
        while ($row = $resultCommonQ->fetch_assoc()) {
            echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

            $resultResponderID = $conn->query("SELECT * FROM responder WHERE Responder_ID = " . $row["Responder_ID"]);
            while ($row = $resultResponderID->fetch_assoc()) {
                echo "<div class=" . "addedBy" . ">Added by :- " . $row["Responder_username"] . "</div></div>";
            }
        }

        // AYATHMA FORM
        ?>
    </div>
    <div class="reply" id="reply">
        <?php
        if (isset($_GET["ID"])) {
            $ID = $_GET["ID"];
            $resultGetSolution = $conn->query("SELECT * FROM solution WHERE RegT_ID =" . $ID);

            while ($row = $resultGetSolution->fetch_assoc()) {
                ?>
                <script>
                    alert("Alredy answered");
                    document.getElementById("reply").style.display = "block";
                    document.getElementById("registered_tickets").style.display = "block";                
                </script>
                <?php

                // echo '<script>';
                // echo 'alert("Alredy answered");';
                // echo 'document.getElementById("reply").style.display = "block";';
                // echo 'document.getElementById("registered_tickets").style.display = "block";'; 
                // echo '</script>';
            }

            if ($resultGetSolution->num_rows == 0) {
                $resultTicket = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $ID);
                while ($row = $resultTicket->fetch_assoc()) {
                    echo "<h1 class=" . "title" . ">" . $row["RegT_title"] . "</h1>";
                    $resultTicketBody = $conn->query("SELECT * FROM reg_tickets WHERE RegT_ID = " . $ID);
                    while ($row = $resultTicketBody->fetch_assoc()) {
                        echo "<div class=" . "body" . ">" . $row["RegT_body"] . "</div>";
                    }
                    echo "<form action=" . "responder.php" . " method=" . "post" . ">
                            <div class=" . "solution" . ">Solution : <textarea name=" . "solution" . " cols=" . "100" . " rows=" . "10" . " style=" . "padding:15px;" . "></textarea></div>
                            <button type=" . "submit" . " name=" . "solutionsubmit" . " class=" . "button" . ">Submit</button>
                        </form>";
                }
            }
        }
        ?>
    </div>
    <?php
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