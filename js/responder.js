let commonQ = document.getElementById("commonQ");
let registered_tickets = document.getElementById("registered_tickets");
let unreg_tickets = document.getElementById("unreg_tickets");
let replyID = document.getElementById("reply");
let url = window.location.href;

function logout() {
    window.location = "http://localhost/Y1S2-Group-Project/adminlogin.php";
}

function showCommonQ() {
    commonQ.style.display = "block";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "none";
    replyID.style.display = "none";
}

function showUnregTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "block";
    replyID.style.display = "none";
}

function showRegTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "block";
    unreg_tickets.style.display = "none";
    replyID.style.display = "none";
    window.location = url;
}

function reply(ID) {
    let currentlocation = window.location.href;
    currentlocation += "&ID=" +ID;
    window.location = currentlocation;
}