let reply = document.getElementById("reply");
let replyClass = document.getElementsByClassName("reply");

function logout(){
    window.location = "http://localhost/Y1S2-Group-Project/login.php";
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
    closeAllReply();
    replyID.style.display = "block";
}