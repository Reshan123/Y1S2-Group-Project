<?php
require "DatabaseConnect.php";
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/navigationBar.css" />
  <title>UJ</title>
</head>

<body>

  <nav>
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




  <div class="common_q">
    <?php
    $sqlCommonQ = "SELECT * FROM common_q";
    $resultCommonQ = $conn->query($sqlCommonQ);
    while ($row = $resultCommonQ->fetch_assoc()) {
      echo "<div class=" . "title" . ">" . $row["CQ_title"] . "</div><br/><div class=" . "body" . ">" . $row["CQ_body"] . "</div><br/>";

      $resultResponderID = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $row["Res_ID"]);
      while ($row = $resultResponderID->fetch_assoc()) {
        echo "<div class=" . "addedBy" . ">Added by :- " . $row["Res_username"] . "</div>";
      }
    }
    ?>
  </div>


  <script src="js/index.js"></script>

</body>

</html>