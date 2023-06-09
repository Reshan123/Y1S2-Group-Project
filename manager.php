<?php
require "DatabaseConnect.php";

if (isset($_COOKIE["ManID"])) {
    $managerID = $_COOKIE["ManID"];
} else {
    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/managers.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <title>Document</title>
</head>

<body>
    <nav>

        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Admin Panel</p>
        <p class="button" onclick="addResponder()">Add Responder</p>
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


    <?php
    //Select all records from table
    $sqlGetResponders = "SELECT * FROM responder";
    $resultGetResponders = $conn->query($sqlGetResponders);

    //Display records in a table with update buttons
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

    //Close database connection
    mysqli_close($conn);
    ?>

    <script src="js/manager.js"></script>
</body>

</html>