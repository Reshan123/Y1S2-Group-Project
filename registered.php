<?php
require "DatabaseConnect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/registered.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <title>Registered User</title>
</head>

<body>
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo" />
        <p class="supportTxt">Support Page</p>
        <p class="button" onclick="goHome()">Home</p>
        <p class="button" onclick="showTickets()">Your Tickets</p>
        <p class="button" onclick="showRaiseT()">Raise Ticket</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon" />
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

            if (isset($_POST["Submit"])) {
                $T_title = $_POST["T_title"];
                $category = $_POST["category"];
                $T_body = $_POST["T_body"];
                $t_ID = 0;
                $RegID = $_COOKIE["ID"];

                $resultGetID = $conn->query("SELECT * FROM reg_tickets");
                while ($rowGetID = $resultGetID->fetch_assoc()) {
                    if ($t_ID < $rowGetID["RegT_ID"]) {
                        $t_ID = $rowGetID["RegT_ID"];
                    }
                }
                $t_ID++;

                $resultInsertRegT = $conn->query("INSERT INTO reg_tickets (RegT_ID,RegT_category,RegT_title,RegT_body,Reg_ID) VALUE ($t_ID,'$category','$T_title','$T_body',$RegID)");

                if ($resultInsertRegT) {
                    header("location:http://localhost/Y1S2-Group-Project/registered.php");
                }
            }

            if (isset($_POST["deleteT"])) {
                $TID = $_POST["deleteT"];
                $resultDeleteRegT = $conn->query("DELETE FROM reg_tickets WHERE RegT_ID = $TID");
                if ($resultDeleteRegT) {
                    header("location:http://localhost/Y1S2-Group-Project/registered.php");
                }
            }
            ?>
        </p>
        </div>
    </nav>

    <div class="header">
        <h1 class="element">We</h1>
        <h1 class="element">Are Here</h1>
        <h1 class="element">To Help</h1>
    </div>

    <div class="askedQ" id="askedQ">
        <h1>Raised Questions</h1>
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
                    echo "<div class=buttons><button class=button id=inActive>Not Replied Yet</button>";
                    echo "<form action=registered.php method=post><button class=button id=colorRed name=deleteT value=" . $rowTicket["RegT_ID"] . ">Delete Ticket</button></form></div>";
                    echo "</div>";
                }
            }
        } else {
            echo "<div class=ticket><div class = title> No Tickets Raised</div><br>";
            echo "<div class = body>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad hic quisquam labore officiis odit iure harum dolorem dolore exercitationem? Porro, cum explicabo sed ipsum expedita aut veritatis modi quod perferendis?</div><br>";
            echo "</div>";
            echo "<div class=ticket><div class = title> No Tickets Raised</div><br>";
            echo "<div class = body>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad hic quisquam labore officiis odit iure harum dolorem dolore exercitationem? Porro, cum explicabo sed ipsum expedita aut veritatis modi quod perferendis?</div><br>";
            echo "</div>";
            echo "<div class=ticket><div class = title> No Tickets Raised</div><br>";
            echo "<div class = body>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad hic quisquam labore officiis odit iure harum dolorem dolore exercitationem? Porro, cum explicabo sed ipsum expedita aut veritatis modi quod perferendis?</div><br>";
            echo "</div>";
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

    <div class="container" id="container">
        <div class="box">
            <h2>Welcome to Cornwell Helpdesk</h2>
            <p>We are here to support you throughout your academic journey. Whether you're a new student seeking information about enrollment, a current student facing technical issues, we're dedicated to providing you with the help you need.Our team of knowledgeable professionals is well-equipped to address a wide range of questions and concerns. From troubleshooting software and hardware problems to guiding you through online learning platforms, we're here to ensure your experience at the university is as smooth as possible.</p>
        </div>
        <div class="services">
            <h2>Services Provided</h2>
            <div class="card card1">
                <div class="title">Raise Tickets</div>
                <div class="body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi fugiat obcaecati eius nostrum cupiditate hic officiis sunt dignissimos itaque corrupti voluptates, cum explicabo? Ducimus quasi nihil odio obcaecati, explicabo ut?</div>
            </div>
            <div class="card card2">
                <div class="title">Delete Tickets</div>
                <div class="body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi fugiat obcaecati eius nostrum cupiditate hic officiis sunt dignissimos itaque corrupti voluptates, cum explicabo? Ducimus quasi nihil odio obcaecati, explicabo ut?</div>
            </div>
            <div class="card card3">
                <div class="title">View Replies</div>
                <div class="body">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi fugiat obcaecati eius nostrum cupiditate hic officiis sunt dignissimos itaque corrupti voluptates, cum explicabo? Ducimus quasi nihil odio obcaecati, explicabo ut?</div>
            </div>
        </div>
    </div>

    
    <div class="footer">
        <div class="container">
        <p class="help">Do you need any help?</p>
        <div class="contact">
            <div><img src="assets/telephone.png" alt="" height="15px" width="15px"> &nbsp;+44 79 7351 4535 <br><img
                src="assets/mail.png" alt="" height="15px" width="15px"> &nbsp; admin@cornell.com</div>
        </div>
        <div class="socails">
            <img src="assets/facebook.png" alt="">
            <img src="assets/twitter.png" alt="">
            <img src="assets/instagram.png" alt="">
        </div>
        <div class="copyright">
            <p>coppyright &copy All rights resevered</p>
        </div>
        </div>
    </div>

    <script src="js/registered.js"></script>
</body>

</html>