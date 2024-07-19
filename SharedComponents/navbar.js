function createNavbar() {
  // add the title of the page to this array
  const pages = ["Create Email", "View Emails", "Contact Us"];

  const navbar = document.getElementById("navbar");
  const navbarInner = document.createElement("div");
  navbarInner.classList.add("navbar-inner");
  const navbarPagesElement = buildNavbarPages(pages);
  navbarInner.appendChild(navbarPagesElement);

  navbar.appendChild(navbarInner);
}

function buildNavbarPages(pages) {
  const navbarPagesContainer = document.createElement("div");
  navbarPagesContainer.classList.add("navbar-pages-container");
  const currentPage = document.title;

  for (const page of pages) {
    if (page === currentPage) {
      const pageElement = document.createElement("p");
      pageElement.textContent = page;
      navbarPagesContainer.appendChild(pageElement);
    } else {
      const pageElement = document.createElement("a");
      pageElement.textContent = page;
      const pagePathName = page.replaceAll(" ", "");
      pageElement.href = `../${pagePathName}/${pagePathName}.html`;
      navbarPagesContainer.appendChild(pageElement);
    }
  }

  return navbarPagesContainer;
}

createNavbar();
