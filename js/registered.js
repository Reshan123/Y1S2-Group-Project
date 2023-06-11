let reply = document.getElementById("reply");
let replyClass = document.getElementsByClassName("reply");
let regTForm = document.getElementById("raiseTForm");
let askedQ = document.getElementById("askedQ");
let container = document.getElementById("container");

function logout(){
    window.location = "http://localhost/Y1S2-Group-Project/";
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
    container.style.display = "none";
}

function showTickets() {
    regTForm.style.display = "none";
    askedQ.style.display = "block";
    container.style.display = "none";
}

function goHome() {
    regTForm.style.display = "none";
    askedQ.style.display = "none";
    container.style.display = "block";
    closeAllReply()
}