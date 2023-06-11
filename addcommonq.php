<?php
    //add the database connection file
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
           // check if responder cookie is set
            if (isset($_COOKIE["ResID"])) {
                //assign it to varibale
                $ResponderID = $_COOKIE["ResID"];
            } else {
                //if responder id is not set
                header("location:http://localhost/Y1S2-Group-Project/adminlogin.php");
            }

            // Retrieve the username of the Responder from the database.
            $sqlManagerName = "SELECT * FROM responder WHERE Res_ID='$ResponderID'";
            $resultManagerName = $conn->query($sqlManagerName);
            while ($row = $resultManagerName->fetch_assoc()) {
                // echo the username to html
                echo $row["Res_username"];
            }
            ?>
        </p>
    </nav>

<!-- add common questions form -->
    <fieldset>
                <legend>Add Common Questions</legend>
                <form action="addcommonq.php" method="post">
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
                    <div class = "Ayabutton">
                        <button type="submit" name="Submit">Submit</button>
                    </div>
                </form>
     </fieldset>
     
    <!-- javascript for returning back to responder page -->
    <script>
        function home() {
            window.location = "http://localhost/Y1S2-Group-Project/responder.php";
        }
    </script>

</body>
</html>
<!-- form data handling -->
<?php
    // check if submit is pressed or not
    if (isset($_POST["Submit"])) 
    {
        //variable for ID
        $CQID = 0;
        // ge the highest id number from the common questions table
        $sqlToGetID = "SELECT * FROM common_q";
        $resultGetID = $conn->query($sqlToGetID);
        while($rowGetID = $resultGetID->fetch_assoc()){
            if($CQID < $rowGetID["CQ_ID"]){
                // assign it to ID variable
                $CQID = $rowGetID["CQ_ID"];
            }
        }
        // add one to it to get a ID for the new ticket
        $CQID++;

        //check if title is empty
        if(empty($_POST['title']))
        {
            // alert if it is empty
            echo "<script>alert('Please Enter Title');</script>";
        }
        else 
        {   
            //assign title to variable
            $title = $_POST['title']; 
            
            // check if body is empty
            if(empty($_POST['body'])){
                //alert if body is empty
                echo "<script>alert('Please Enter body text');</script>";
            } else {
                //assign body to variable
                $body = $_POST['body'];
                // assign category to variable 
                $category = $_POST["category"];

                //sql to add the common question to database
                $sql = "INSERT INTO common_q(CQ_ID,CQ_title, CQ_body, CQ_Category,Res_ID) VALUES($CQID,'$title', '$body', '$category',$ResponderID)"; //inserting data in to the database
                $query_run = mysqli_query($ayacon, $sql); // running the query 

                if($query_run) 
                {
                    //if query is runnign successfully send to responder page
                    header("Location: responder.php");
                }
            }  
        }      
        
    }
?>