let supportLogo = document.getElementById("supportLogo").addEventListener("click",gotomanager);
let URL = window.location.href;


function gotomanager() {
    window.location = URL;
}

function logout() {
    window.location = "http://localhost/Y1S2-Group-Project/adminlogin.php";
}