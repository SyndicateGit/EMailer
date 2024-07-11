
function createNavbar() {
  const navbar = document.getElementById("navbar");
  const childNode = document.createElement("div");
  childNode.appendChild(document.createTextNode("Navbar"));
  navbar.appendChild(childNode);
}

createNavbar();
