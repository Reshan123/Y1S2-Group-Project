<?php
    $title = $category = $body = '';
   

?>


<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/login.css" />
    </head>
<body>	
    <center style="padding:50px 0px;">
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
                            <label>Body of Question</label>
                            <input type = "text" name = "body" value = "<?php echo $body ?>">
                            <div>
                            <label>Category of Questions</label>
                            </div>
                            <div>
                            <select name="cateogry" size="4" multiple>
                                <option value="semester">Semester</option>
                                <option value="orientation">Orientation</option>
                                <option value="scholarship">Scholarships</option>
                                <option value="loan">Student Loan</option>
                                </select>
                            </div>
                        </div>              


                    </div>

                    <div class = "button">
                        <button type="submit" name="Submit">Submit</button>
                    </div>
                </form>
     </fieldset>


</body>
</html>