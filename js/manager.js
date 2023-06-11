let commonQ = document.getElementById("commonQ");
let registered_tickets = document.getElementById("registered_tickets");
let unreg_tickets = document.getElementById("unreg_tickets");
let manageResponders = document.getElementById("manageResponders");

function gotomanager() {
    window.location = URL;
}

function logout() {
    window.location = "http://localhost/Y1S2-Group-Project/adminlogin.php";
    document.cookie = "ManID=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function addResponder() {
    window.location = "http://localhost/Y1S2-Group-Project/manageresponder.php";
}

function showCommonQ() {
    commonQ.style.display = "block";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "none";
    manageResponders.style.display = "none";
}

function showUnregTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "block";
    manageResponders.style.display = "none";
}

function showRegTickets() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "block";
    unreg_tickets.style.display = "none";
    manageResponders.style.display = "none";
}

function showmanageResponders() {
    commonQ.style.display = "none";
    registered_tickets.style.display = "none";
    unreg_tickets.style.display = "none";
    manageResponders.style.display = "block";
}