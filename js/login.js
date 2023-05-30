let Unregistered = document.getElementById("Unregistered");
let UnregisteredText = document.getElementById("UnregisteredText").addEventListener("click" , UnregisteredSelect);

let Registered = document.getElementById("Registered");
let RegisteredText = document.getElementById("RegisteredText").addEventListener("click" , RegisteredSelect);


function UnregisteredSelect() {
    Unregistered.checked = true;
}

function RegisteredSelect () {
    Registered.checked = true;
}


