let supportLogo = document.getElementById("supportLogo").addEventListener("click",gotomanager);
let URL = window.location.href;


function gotomanager() {
    window.location = URL;
}

function logout() {
    window.location = "http://localhost/Y1S2-Group-Project/adminlogin.php";
    document.cookie = "ManID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}