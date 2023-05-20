let profilePic =  document.getElementById("profilePic").addEventListener("click", changePage);
let logInStatus = document.getElementById("logInStatus").addEventListener("click", changePage);
let supportLogo = document.getElementById("supportLogo").addEventListener("click", goToHome);


function changePage () {
    let currentURL = window.location.href;
    if (currentURL.length == 33){
        currentURL += "login.php";
    }
    window.location = currentURL;
}

function goToHome() {
    window.location = "http://localhost/Y1S2-Group-Project/";
}