
function createHeader() {
  const header = document.getElementById("header");
  const headerInner = document.createElement("div");
  headerInner.classList.add('header-inner')
  const headerContent = document.createElement('h1');
  headerContent.textContent = 'EMAILER';
  headerInner.appendChild(headerContent)
  header.appendChild(headerInner);
}

createHeader();
