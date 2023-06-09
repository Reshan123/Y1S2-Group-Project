let commonQ =  document.getElementById("commonQ");

function changePage () {
    window.location = "http://localhost/Y1S2-Group-Project/login.php"
}

function goToHome() {
    window.location = "http://localhost/Y1S2-Group-Project/";
}

const observer = new IntersectionObserver(entries => {
    // Loop over the entries
    entries.forEach(entry => {
      // If the element is visible
      if (entry.isIntersecting) {
        // Add the animation class
        entry.target.classList.add('animate');
      } else {
        entry.target.classList.remove('animate');
      }
    });
  });
  
document.querySelectorAll('.ticket').forEach(element => {observer.observe(element)});