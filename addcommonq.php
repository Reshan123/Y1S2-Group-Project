<?php
    require "DatabaseConnect.php";
    //establish connection 
    $ayacon=mysqli_connect("localhost","root","","supportdesk");
    $title = $category = $body = ''; //variables
?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/addcommonq.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <title>Responder</title>
    </head>
<body>	

<!-- navigation bar -->
    <nav>
        <img src="assets/cornell.png" alt="LOGO" class="logo"/>
        <p class="supportTxt">Admin Panel</p>
        <p class="button" onclick="home()">Home</p>
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
                            <select name="category">
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
     
    <script>
        function home() {
            window.location = "http://localhost/Y1S2-Group-Project/responder.php";
        }
    </script>

</body>
</html>

<?php
    if (isset($_POST["Submit"])) 
    {
        $CQID = 0;

        $sqlToGetID = "SELECT * FROM common_q";
        $resultGetID = $conn->query($sqlToGetID);
        while($rowGetID = $resultGetID->fetch_assoc()){
            if($CQID < $rowGetID["CQ_ID"]){
                $CQID = $rowGetID["CQ_ID"];
            }
        }
        $CQID++;
        if(empty($_POST['title']))
        {
            echo "<script>alert('Please Enter Title');</script>";
        }
        else 
        {   
            $title = $_POST['title'];  
            if(empty($_POST['body'])){
                echo "<script>alert('Please Enter body text');</script>";
            } else {
                $body = $_POST['body'];
                $category = $_POST["category"];
                $sql = "INSERT INTO common_q(CQ_ID,CQ_title, CQ_body, CQ_Category,Res_ID) VALUES($CQID,'$title', '$body', '$category',$ResponderID)"; //inserting data in to the database
                $query_run = mysqli_query($ayacon, $sql); // running the query 

                if($query_run) //if query is runnign successfully 
                {
                    echo "Added Successfully";
                    header("Location: responder.php");
                }
            }  
        }      
        
    }
?>