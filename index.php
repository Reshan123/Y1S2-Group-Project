<?php
require "DatabaseConnect.php"; // Include the file that connects to the database
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/navigationBar.css" />
  <title>Document</title>
</head>

<body>

  <nav>
    <!-- Navigation bar -->
    <div class="leftAlign" id="supportLogo">
      <img src="assets/logo.png" alt="LOGO" />
      <p>Support Page</p>
    </div>
    <div class="rightAlign">
      <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
        <img src="assets/profileicon.png" alt="profile icon" />
      </div>
      <p class="logInStatus" id="logInStatus">Not Logged In</p>
    </div>
  </nav>

  <div class="header">
    <h1>Welcome Cornwell Univeristy</h1>
    <p></p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus molestiae blanditiis animi delectus voluptate veniam enim architecto itaque veritatis, ab rem distinctio aliquid nihil cum fugiat quibusdam cupiditate odio harum et deserunt. Consequuntur dolorem ab aspernatur eaque quae tenetur dolores totam labore, ipsa officia ad, dolore alias! Veritatis, accusamus eligendi.</p>
  </div>

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

  <div class="footer">
    <p>coppyright &copy All rights resevered</p>
  </div>

  <script src="js/index.js"></script> <!-- Include JavaScript file for additional functionality -->

</body>

</html>
