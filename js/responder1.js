let commonQ = document.getElementById("commonQ");
let registered_tickets = document.getElementById("registered_tickets");
let unreg_tickets = document.getElementById("unreg_tickets");

function logout() {
    window.location = "http://localhost/Y1S2-Group-Project/adminlogin.php";
}

function showCommonQ() {
    commonQ.style.display = "block";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "none";
}

function showUnregTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "block";
}

function showRegTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "block";
    unreg_tickets.style.display = "none";
}