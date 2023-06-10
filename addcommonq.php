<?php
    require "DatabaseConnect.php";
    //establish connection 
    $ayacon=mysqli_connect("localhost","root","","supportdesk");
    $title = $category = $body = ''; //variables
     //connecting to the database
     $sql = "INSERT INTO common_q(CQ_title, CQ_body, CQ_Category) VALUES('$title', '$category', '$body')";

    
    
    if (isset($_POST["Submit"])) 
    {
        $title = $_POST["title"];
        $category= $_POST["category"];
        $body = $_POST["body"];

      
        if(mysqli_query($ayacon, $sql))
        {
            // succesfully added to database 
            // redirect to the first page 
        }
        else 
        {
            echo 'error with query' . mysqli_error($ayacon); // error display error
        }
    }
    
    
    

?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/addcommonq.css" />
    <link rel="stylesheet" href="css/navigationBar.css" />
    </head>
<body>	

<!-- navigation bar -->
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/cornell (1).png" alt="LOGO" />
            <p>Support Page > Staff</p>
        </div>
        <div class="rightAlign">
            <a href = "index.php">
            <p class="button">Home</p>
            </a>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
                <button class="logout" onclick="logout()">Logout</button>
            </div>
            <p id="logInStatus">
                <?php
                // Get the Responder ID from the URL.
                if (isset($_COOKIE["ResID"])) {
                    $ResponderID = $_COOKIE["ResID"];
                } else {
                    header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
                }

                // Retrieve the username of the Responder from the database.
                $sqlManagerName = "SELECT * FROM responder WHERE Res_ID='$ResponderID'";
                $resultManagerName = $conn->query($sqlManagerName);
                while ($row = $resultManagerName->fetch_assoc()) {
                    echo $row["Res_username"];
                }
                ?>
            </p>
        </div>
    </nav>
<!-- navigation bar -->


    <fieldset>
                <legend>Add Common Questions</legend>
                <!-- Login form -->
                <form action="addcommonq.php" method="post">

                    <!-- User type selection -->
                    <div class="addcommonqform">
                        <div>
                            <div>
                            <lable>Title of Question</label>
                            <input type = "text" name = "title" value = "<?php echo $title ?>">
                            </div>
                            <br>
                            <div>
                            <label>Body of Question</label>
                            <input type = "text" name = "body" value = "<?php echo $body ?>">
                            </div>
                            <br>
                            <div>
                            <label>Category of Questions</label>
                            <select name="cateogry">
                                <option value="semester">Semester</option>
                                <option value="orientation">Orientation</option>
                                <option value="scholarship">Scholarships</option>
                                <option value="loan">Student Loan</option>
                             </select>
                             <br>
                            </div>
                            
                           
                            
                        </div>              


                    </div>
                    <br>
                    <!-- PLEASE DONT TOUCH AYABUTTON -->
                    <div class = "Ayabutton">
                        
                        <button type="submit" name="Submit">Submit</button>
                        
                    </div>
                </form>
     </fieldset>


</body>
</html>