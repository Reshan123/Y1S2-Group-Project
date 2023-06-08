let raiseTForm = document.getElementById("raiseTForm");
let commonQ = document.getElementsByClassName("common_q");


function logout(){
    window.location = "http://localhost/Y1S2-Group-Project/login.php";
    document.cookie = "ID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
} 



function showRaiseT() {
    raiseTForm.style.display = "block";
    commonQ.style.display = "none";
}


function showCommonQ() {
    raiseTForm.style.display = "none";
    commonQ.style.display = "block";
}
