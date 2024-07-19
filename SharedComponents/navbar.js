
function createNavbar() {
  const navbar = document.getElementById("navbar");
  const navbarInner = document.createElement("div");
  navbarInner.classList.add('navbar-inner')

  const navbarContent = document.createElement('h2')
  navbarContent.textContent = 'Home'
  navbarInner.appendChild(navbarContent);
  navbar.appendChild(navbarInner);
}

createNavbar();
