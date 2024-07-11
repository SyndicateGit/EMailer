
function createHeader() {
  const navbar = document.getElementById("header");
  const childNode = document.createElement("div");
  childNode.appendChild(document.createTextNode("Header"));
  navbar.appendChild(childNode);
}

createHeader();
