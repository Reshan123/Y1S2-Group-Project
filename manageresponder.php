<?php
require "DatabaseConnect.php"; //database connection file

// check if manager cookies is set
if (isset($_COOKIE["ManID"])) {
    $managerID = $_COOKIE["ManID"];
} else {
    //if cookie is not set
    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/manageresponder.css" />
    <link rel="stylesheet" href="css/navbar.css">
    <title>Manager</title>
</head>

<body>
    <!-- navigation bar -->
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo" />
        <p class="supportTxt">Admin Panel</p>
        <p class="button" onclick="goHome()">Home</p>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon" />
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

    <!-- responders update form -->
    <div class="update">
        <?php
        if (isset($_GET["UpdateID"])) { //if update is set

            // get the id from the url
            $updateID = $_GET["UpdateID"];
            //assign it to cookie
            setcookie("updateID", $updateID, time() + 3600, "/");

            //sql to get reaponders details
            $resultResponderDetails = $conn->query("SELECT * FROM responder WHERE Res_ID = " . $updateID);

            while ($row = $resultResponderDetails->fetch_assoc()) {
                //display the details in a form
                echo "<fieldset>
                        <legend>Update responder</legend>
                        <form action=manageresponder.php method=post>
                            <p>Name</p>  <input type=text name=name id=name value=" . $row["Res_username"] . "><br>
                            <p>Email</p>  <input type=text name=email id=email value=" . $row["Res_email"] . "><br>
                            <p>Password</p>  <input type=text name=pwd id=pwd value=" . $row["Res_password"] . "><br>
                            <button class=button name=update>Update</button>
                        </form>
                    </fieldset>";
            }
        } else if (isset($_GET["DeleteID"])) { // if delete is it

            // get delete id from url
            $deleteID = $_GET["DeleteID"];
            //sql for deletion
            $resultDelete = $conn->query("DELETE FROM responder WHERE Res_ID=" . $deleteID);

            //if deleted
            if ($resultDelete) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }

        } else { // if not display the add responders form
            echo "<fieldset>
                        <legend>Add responder</legend>
                        <form action=manageresponder.php method=post>
                            <p>Name</p>  <input type=text name=nameAdd id=name><br>
                            <p>Email</p>  <input type=text name=emailAdd id=email><br>
                            <p>Password</p>  <input type=text name=pwdAdd id=pwd><br>
                            <button class=button name=add>Update</button>
                        </form>
                    </fieldset>";
        }


        if (isset($_POST["update"])) { // if responder detials updated

            // assign the values to vairables
            $name = $_POST["name"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            //get id from cookie
            $updateCookie = $_COOKIE["updateID"];
            //sql for updating
            $resultUpdateRecord = $conn->query("UPDATE responder SET Res_username='$name' , Res_email='$email' , Res_password='$pwd' WHERE Res_ID=$updateCookie");
            //if updated
            if ($resultUpdateRecord) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }
        }

        if (isset($_POST["add"])) { //if add responder form is submited

            //assign the values to variable
            $nameAdd = $_POST["nameAdd"];
            $emailAdd = $_POST["emailAdd"];
            $pwdAdd = $_POST["pwdAdd"];
            // get manager id from cookie
            $managerID = $_COOKIE["ManID"];
            //get the highest responder id
            $IDAdd = 0;
            $resultHighestID = $conn->query("SELECT * FROM responder");

            while ($row = $resultHighestID->fetch_assoc()) {
                if ($IDAdd < $row["Res_ID"]) {
                    $IDAdd = $row["Res_ID"];
                }
            }
            // add one to the highest responder id
            $IDAdd++;

            //insert statement to add responders
            $resultInsert = $conn->query("INSERT INTO responder(Res_ID,Res_username,Res_email,Res_password,Man_ID) VALUES ($IDAdd,'$nameAdd','$emailAdd','$pwdAdd',$managerID)");
            //if responder added
            if ($resultInsert) {
                header("Location:http://localhost/Y1S2-Group-Project/manager.php");
            }
        }
        ?>


    </div>
    
    <!-- javascript for more functions -->
    <script>
        function goHome() {
            document.location = "http://localhost/Y1S2-Group-Project/manager.php";
            document.cookie = "updateCookie=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    </script>

</body>

</html>