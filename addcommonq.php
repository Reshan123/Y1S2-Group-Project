<?php
    require "DatabaseConnect.php";
    //establish connection 
    $ayacon=mysqli_connect("localhost","root","","supportdesk");
    $title = $category = $body = ''; //variables
     

    
    
    if (isset($_POST["Submit"])) 
    {
        $title = $_POST["title"];
        $category= $_POST["category"];
        $body = $_POST["body"];

        

        $sql = "INSERT INTO common_q(CQ_title, CQ_body, CQ_Category) VALUES('$title', '$body', '$category')"; //inserting data in to the database
        $query_run = mysqli_query($ayacon, $sql); // running the query 

      
        if(query_run) //if query is runnign successfully 
        {
            echo "Added Successfully";
            header("Location: addcommonq.php");
        }
        {
            echo "Not added Successfully";
            header("Location: addcommonq.php");
        }
    }
    
    
    

?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/addcommonq.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    </head>
<body>	

<!-- navigation bar -->
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Admin Panel</p>
        <a href = "responder.php"><p class="button">Home</p></a>
        <img src="assets/profileicon.png" alt="profile icon" class="profileIcon"/>
        <button class="logout" onclick="logout()">Logout</button>    
        <p id="logInStatus" class="logInStatus">
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