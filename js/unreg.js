let raiseTForm = document.getElementById("raiseTForm");
let commonQ = document.getElementById("commonQ");

function logout(){
    window.location = "http://localhost/Y1S2-Group-Project/login.php";
} 



function showRaiseT() {
    raiseTForm.style.display = "block";
    commonQ.style.display = "none";
}


function showCommonQ() {
    raiseTForm.style.display = "none";
    commonQ.style.display = "block";
}
