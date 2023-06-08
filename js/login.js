let Unregistered = document.getElementById("Unregistered");
let UnregisteredText = document
  .getElementById("UnregisteredText")
  .addEventListener("click", UnregisteredSelect);

let Registered = document.getElementById("Registered");
let RegisteredText = document
  .getElementById("RegisteredText")
  .addEventListener("click", RegisteredSelect);

let supportLogo = document
  .getElementById("supportLogo")
  .addEventListener("click", Gotohome);

let emailInput = document.getElementById("emailInput");
let PwdInput = document.getElementById("PwdInput");

function UnregisteredSelect() {
  Unregistered.checked = true;
  emailInput.value = "Unreg@my.cornwill.us";
  PwdInput.value = "UnregPassword";
}

function RegisteredSelect() {
  Registered.checked = true;
  emailInput.value = "";
  PwdInput.value = "";
}

function Gotohome() {
  window.location = "http://localhost/Y1S2-Group-Project/";
}
