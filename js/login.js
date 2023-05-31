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

function UnregisteredSelect() {
  Unregistered.checked = true;
}

function RegisteredSelect() {
  Registered.checked = true;
}


function Gotohome() {
  window.location = "http://localhost/Y1S2-Group-Project/";
}
