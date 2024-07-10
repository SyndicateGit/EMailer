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

## SharedComponents:
Contains js scripts that help render shared components. For example: header.js and footer.js would find element with id="header" and id="footer" and generate child HTML nodes to create the header and footer.

## Setup:
1. npm install
2. Copy .env.example content into your own .env file
3. Ask for .env secrets