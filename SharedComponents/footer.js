
function createNavbar() {
  const footer = document.getElementById("footer");
  const footerContainer = document.createElement("div");
  footerContainer.classList.add('footer-container')
  const footerContent = document.createElement('p')
  footerContent.textContent = 'I AM A FOOTER'
  footerContainer.appendChild(footerContent);
  footer.appendChild(footerContainer);
}

createNavbar();
