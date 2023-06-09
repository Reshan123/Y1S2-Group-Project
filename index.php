<?php
require "DatabaseConnect.php"; // Include the file that connects to the database
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/index.css" />
  <!-- <link rel="stylesheet" href="css/navigationBar.css" /> -->
  <link rel="stylesheet" href="css/navbarOnprogress.css" />
  <title>Document</title>
</head>

<body>

  <!-- Navigation bar -->
  <nav>
    <img src="assets/cornell.png" alt="LOGO" class="logo" />
    <p class="supportTxt">Support Page</p>
    <img src="assets/profileicon.png" alt="profile icon" class="profileIcon" />
    <p class="logInStatus" id="logInStatus">Not Logged In</p>
  </nav>

  <div class="header">
    <img src="assets/Cornell (1).png" alt="LOGO">
    <h1 class="element1">Welcome</h1>
  </div>

  <div class="common_q" id="commonQ">
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

  <script src="js/index.js"></script> <!-- Include JavaScript file for additional functionality -->

</body>

</html>