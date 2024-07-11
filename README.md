# BirthdayReminderBuddy
Track and automate email reminders for birthdays. 

## Structure: 
- /Pages 
  - /Page
    - page.html
    - page.module.css
    - page.js
- /SharedComponents
  - component.js

## Pages 
contains folders pertaining to individual pages with corresponding html, module.css and js files. 

Includes a template_page.js and template_css.module.css to copy into respective page.html and page.module.css files to have the basic layout of the page persist accross pages.

## SharedComponents:
Contains js scripts that help render shared components. For example: header.js and footer.js would find element with id="header" and id="footer" and generate child HTML nodes to create the header and footer.

These are used to create the template of the page and linked in template_page.html to create the basic layout every page has (header on top, navbar on side, footer on bottom).

## Setup:
1. Copy .env.example content into your own .env file
2. Ask for .env secrets