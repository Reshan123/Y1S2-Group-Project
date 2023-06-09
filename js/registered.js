let reply = document.getElementById("reply");
let replyClass = document.getElementsByClassName("reply");
let regTForm = document.getElementById("raiseTForm");
let askedQ = document.getElementById("askedQ");

function logout(){
    window.location = "http://localhost/Y1S2-Group-Project/index.php";
    document.cookie = "ID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
} 


function closeAllReply() {
    
    let x = 0;
    while(x < replyClass.length){
        replyClass[x].style.display = "none";
        x++;
    } 
}

function showSolution(id) {
    
    let replyID = document.getElementById(id);
    replyID.style.display = "block";
}

function showRaiseT() {
    regTForm.style.display = "block";
    askedQ.style.display = "none";
}

function goHome() {
    regTForm.style.display = "none";
    askedQ.style.display = "block";
}

