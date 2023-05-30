<?php
require "DatabaseConnect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/managers.css" />
    <link rel="stylesheet" href="css/navigationBar.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page > Manager</p>
        </div>
        <div class="rightAlign">
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php $managerID = $_GET["managerid"];
                $sqlManagerName = "SELECT * FROM manager WHERE Manager_ID='$managerID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Manager_username"];
                }
                ?>
            </p>
        </div>
    </nav>


    <?php
    //Select all records from table
    $sqlGetResponders = "SELECT * FROM responder";
    $resultGetResponders = $conn->query($sqlGetResponders);

    //Display records in a table with update buttons
    echo "<table>";
    echo "<tr><td>ID</td><td>Email</td><td>Name</td><td>Password</td><td>Action</td></tr>";
    while ($row = $resultGetResponders->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Responder_ID'] . "</td>";
        echo "<td>" . $row['Responder_email'] . "</td>";
        echo "<td>" . $row['Responder_username'] . "</td>";
        echo "<td>" . $row['Responder_password'] . "</td>";
        echo "<td><a href='update.php?id=" . $row['Responder_ID'] . "'>Update</a></td>";
        echo "</tr>";
    }
    echo "</table>";

    //Close database connection
    mysqli_close($conn);
    ?>

    <script src="js/manager.js"></script>
</body>

</html>