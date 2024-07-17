
function createNavbar() {
  const footer = document.getElementById("footer");
  const footerInner = document.createElement("div");
  footerInner.classList.add('footer-inner');
  const footerContent = document.createElement('p');
  footerContent.textContent = 'COMP3340 Final Project';
  footerInner.appendChild(footerContent);
  footer.appendChild(footerInner);
}

createNavbar();
