# EMailer
Online Email App. Create and send emails online.

## Structure: 
- /Pages 
  - /Page
    - page.html
    - page.module.css
    - page.js
    - page.php
- /SharedComponents
  - component.js

## Pages 
contains folders pertaining to individual pages with corresponding html, module.css and js files. 

Also includes page.php file to handle XMLHttpRequest requests from the page. 
Refer to https://www.w3schools.com/xml/xml_http.asp for example.

Includes a template_page.js and template_css.module.css to copy into respective page.html and page.module.css files to have the basic layout of the page persist accross pages.

Pages:
- Login
- Signup
- Create Email (uses TinyMCE for email body)
- View Emails page (includes delete email button and edit button)
- Contact Us Page
- Edit Emails page (done after create Email page)

## SharedComponents:
Contains js scripts that help render shared components. For example: header.js and navbar.js would find element with id="header" and id="navbar" and generate child HTML nodes to create the header and footer.

These are used to create the template of the page and linked in template_page.html to create the basic layout every page has (header on top, navbar below header, main after. Signup/Login doesn't have nav).

Header: Includes App name on left, Signin/Signout button on right (show depending on if user is signed in(we can use local storage to create user sessions)).

Navbar: Links to Create Email and View Emails page.


## Setup:
1. Open up the terminal in the directory of your choosing.
2. Run git clone https://github.com/SyndicateGit/EMailer.git
3. Double click index.html to load onto your browser. If you have VSCode you can install an extension called Live Server that helps with launching your index.html page and updating it whenever you save a change to your files.
4. PHP won't run locally. For now you can do all your pages in html/css/js and then we'll figure out the form submission and data fetching later. The backend team will handle all the PHP scripting stuff once your forms are completed. We'll upload it to myweb to test out the backend afterwards.
