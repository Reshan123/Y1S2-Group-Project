let Staff = document.getElementById("Staff");
let StaffText =  document.getElementById("StaffText").addEventListener("click" , StaffSelect);

let Manager = document.getElementById("Manager");
let ManagerText = document.getElementById("ManagerText").addEventListener("click" , ManagerSelect);

function StaffSelect () {
    Staff.checked = true;
}

function ManagerSelect () {
    Manager.checked =  true;
}
