let Unregistered = document.getElementById("Unregistered");
let UnregisteredText = document.getElementById("UnregisteredText").addEventListener("click" , UnregisteredSelect);

let Registered = document.getElementById("Registered");
let RegisteredText = document.getElementById("RegisteredText").addEventListener("click" , RegisteredSelect)

let Staff = document.getElementById("Staff");
let StaffText =  document.getElementById("StaffText").addEventListener("click" , StaffSelect);

let Manager = document.getElementById("Manager");
let ManagerText = document.getElementById("ManagerText").addEventListener("click" , ManagerSelect);

function UnregisteredSelect() {
    Unregistered.checked = true;
}

function RegisteredSelect () {
    Registered.checked = true;
}

function StaffSelect () {
    Staff.checked = true;
}

function ManagerSelect () {
    Manager.checked =  true;
}
