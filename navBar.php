<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/navBar.css" />
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="leftAlign" id="supportLogo">
            <img src="assets/logo.png" alt="LOGO" />
            <p>Support Page</p>
        </div>
        <div class="rightAlign">
            <form action="index.php" class="searchBar">
                <input type="text" name="search" />
                <button type="submit">Search</button>
            </form>
            <div class="profileImage" tooltip="NOT LOGGED IN" id="profilePic">
                <img src="assets/profileicon.png" alt="profile icon" />
            </div>
            <p id="logInStatus">Not Logged In</p>
        </div>
    </nav>

    <script src="js/navBar.js"></script>
</body>

</html>