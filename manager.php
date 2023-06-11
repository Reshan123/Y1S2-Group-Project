<?php
require "DatabaseConnect.php"; //database connection file

//if manager cookies is set
if (isset($_COOKIE["ManID"])) {
    $managerID = $_COOKIE["ManID"];
} else {
    //if cookie not set
    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/managers.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <title>Manager</title>
</head>

<body>

    <!-- navigation bar -->
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Admin Panel</p>
        <p class="button" onclick="showmanageResponders()">Manage Responders</p>
        <p class="button" onclick="showRegTickets()">Registered Tickets</p>
        <p class="button" onclick="showUnregTickets()">Unregistered Tickets</p>
        <p class="button" onclick="showCommonQ()">Common Questions</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <button class="logout" onclick="logout()">Logout</button>

        <p id="logInStatus" class="logInStatus">
            <?php
            $sqlManagerName = "SELECT * FROM manager WHERE Man_ID='$managerID'";
            $resultManagerName = $conn->query($sqlManagerName);
            while ($row = $resultManagerName->fetch_assoc()) {
                echo $row["Man_username"];
            }
            ?>
        </p>

    </nav>

    <!-- managing responders area -->
    <div class="manageResponders" id="manageResponders">
        <!-- add responders button -->
        <p class="button responders" onclick="addResponder()">Add Responder</p>
        <?php
        //Select all records from table
        $sqlGetResponders = "SELECT * FROM responder";
        $resultGetResponders = $conn->query($sqlGetResponders);

        //Display records in a table with update and delete buttons
        echo "<table>";
        echo "<tr><td>ID</td><td>Email</td><td>Name</td><td>Password</td><td>Action</td></tr>";
        while ($row = $resultGetResponders->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Res_ID'] . "</td>";
            echo "<td>" . $row['Res_email'] . "</td>";
            echo "<td>" . $row['Res_username'] . "</td>";
            echo "<td>" . $row['Res_password'] . "</td>";
            echo "<td><a class=update href='manageresponder.php?UpdateID=" . $row['Res_ID'] . "'>Update</a><a class=delete href='manageresponder.php?DeleteID=" . $row['Res_ID'] . "'>Delete</a></td>";
            echo "</tr>";
            
        }
        echo "</table>";

        ?>
    </div>

    <!-- managing tickets area -->
    <div class="manageTickets">
        <!-- Registered tickets -->
        <div class="regT" id="registered_tickets">
            <h1>Registered Tickets</h1>
            <div class=alltickets>    
                <?php
                // Retrieve all registered tickets from the database.
                $sqlRegT = "SELECT * FROM reg_tickets";
                $resultRegT = $conn->query($sqlRegT);
                
                while ($rowRegT = $resultRegT->fetch_assoc()) {
                    // Display each registered ticket.
                    echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $rowRegT["RegT_title"] . "</div><br/><div class=" . "body" . ">" . $rowRegT["RegT_body"] . "</div><br/>";
                    $sqlReplyCheck = $conn->query("SELECT * FROM solution WHERE RegT_ID=" . $rowRegT["RegT_ID"]);
                    // Retrieve the username of the user who added the ticket.
                    $resultStuID = $conn->query("SELECT * FROM registered_user WHERE Reg_ID = " . $rowRegT["Reg_ID"]);
                    while ($rowRegUser = $resultStuID->fetch_assoc()) {
                        echo "<div class=" . "addedBy" . ">Added by :- " . $rowRegUser["Reg_username"] . "</div>";
                    }
                    if ($sqlReplyCheck->num_rows == 0) {
                        //if reply doesnt exsist display delete button
                        echo "<form action=manager.php method=post><input name=regid value=" . $rowRegT["RegT_ID"] . "><button class=delete name=delete>Delete</button></form>";
                    } else {
                        //if already replies
                        echo "<div class=replyAgain><button class=button>Already Replied</button></div>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <!-- unregistered tickets -->
        <div class="unreg_tickets" id="unreg_tickets">
            <h1>Unregistered Tickets</h1>
            <div class=alltickets>
                <?php
                // Retrieve all unregistered tickets from the database.
                $sqlRegT = "SELECT * FROM unreg_tickets";
                $resultRegT = $conn->query($sqlRegT);
                while ($row = $resultRegT->fetch_assoc()) {
                    // Display each unregistered ticket with delete buttons.
                    echo "<div class=" . "ticket" . "><div class=" . "title" . ">" . $row["UnregT_title"] . "</div><br/><div class=" . "body" . ">" . $row["UnregT_body"] . "</div><br/><br/>";
                    echo "<div class=" . "addedBy" . ">Added by :- " . $row["UnregT_pemail"] . "</div><form action=manager.php method=post><input name=unregid value=" . $row["UnregT_ID"] . "><button class=delete name=delete>Delete</button></form></div>";
                }
                ?>
            </div>
        </div>
        <!-- common questions -->
        <div class="common_q" id="commonQ">
            <h1>Common Questions</h1>
            <div class=alltickets>
                <?php
                $sqlCommonQ = "SELECT * FROM common_q";
                $resultCommonQ = $conn->query($sqlCommonQ);
                
                // Fetch and display common questions from the database
                while ($rowCommonQ = $resultCommonQ->fetch_assoc()) {
                    echo "<div class=ticket><div class=" . "title" . ">" . $rowCommonQ["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $rowCommonQ["CQ_body"] . "</div><br/>";

                    // Fetch and display the responder who added the question and adds the delete button
                    $resultResponderID = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $rowCommonQ["Res_ID"]);
                    while ($rowResponder = $resultResponderID->fetch_assoc()) {
                        echo "<div class=" . "addedBy" . ">Added by :- " . $rowResponder["Res_username"] . "</div><form action=manager.php method=post><input name=CQID value=" . $rowCommonQ["CQ_ID"] . "><button class=delete name=delete>Delete</button></form></div>";
                    }
                }
                ?>
            </div>
    </div>
            
    <!-- javascript file for more functions -->
    <script src="js/manager.js"></script>

    <?php
        // if delete one of the button is pressed
        if (isset($_POST["delete"])){
            if (isset($_POST["regid"])){ //check if it was a registered ticket

                // get ticket id
                $RID = $_POST["regid"];
                //sql for deletion
                $resultRegT = $conn->query("DELETE FROM reg_tickets WHERE RegT_ID = ".$RID);
                if ($resultRegT) {
                    //if ticket deleted
                    echo "<script>alert('Ticket Deleted')</script>";
                }
            } else if (isset($_POST["unregid"])){ //check if it was a unregistered ticket
                
                // get ticket id
                $UID = $_POST["unregid"];
                //sql for deletion
                $resultUnregT = $conn->query("DELETE FROM unreg_tickets WHERE UnregT_ID = " .$UID);
                if ($resultUnregT) {
                    //if ticket deleted
                    echo "<script>alert('Ticket Deleted')</script>";
                }
            } else if (isset($_POST["CQID"])){ //check if it was a common question
                
                // get ticket id
                $CQID = $_POST["CQID"];
                //sql for deletion
                $resultCQ = $conn->query("DELETE FROM common_q WHERE CQ_ID = ".$CQID);
                if ($resultCQ) {
                    //if ticket deleted
                    echo "<script>alert('Ticket Deleted')</script>";
                }
            }
        }
    ?>
</body>

</html>