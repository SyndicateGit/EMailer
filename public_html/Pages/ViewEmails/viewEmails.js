// TinyMCE initialization for main editor and email body editor
const emailBodyConfig = {
  promotion: false,
  selector: '#email-body-editor',
};

const mainTinyMCEInit = {
  promotion: false,
  license: 'gpl',
};

tinymce.init(mainTinyMCEInit);
tinymce.init(emailBodyConfig);

// global variable to store fetched email data
var globalFromEmail;
var globalEmails;

// Functions to fetch the from email field (user's email) 
// and then fetch the emails corresponding to user id from session
function fetchEmailStuff(callback) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var from_email = '' + this.responseText;
      setFromField(from_email);
    } 
    if(this.responseText.trim() == 'Please login to view this page'){
      window.location.href = '../Login/login.html';
    }
  };
  xmlhttp.open("GET", "fetchFromEmail.php", true);
  xmlhttp.send();
}

function setFromField(from_email){
  globalFromEmail = from_email;
  fetchEmails(generateEmails);
}

function fetchEmails(callback){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if ('' + this.readyState == 4 && this.status == 200) {
      try{
        if(this.responseText.trim() == 'No emails found'){
          document.getElementById('debug').innerHTML = this.responseText;
          generateEmails([]);
          return;
        }
        // Redirect to login page if not logged in
        if(this.responseText.trim() == 'Please login to view this page'){
          window.location.href = '../Login/login.html';
        }
        var emails = JSON.parse(this.responseText.trim());
        generateEmails(emails);
      } catch(e){
        console.log(e);
        document.getElementById('debug').innerHTML = this.responseText;
        callback([]);
      }
      
    } else {
      console.log("Error fetching emails");
    }
  };
  xmlhttp.open("GET", "fetchEmails.php", true);
  xmlhttp.send();
}

function generateEmails(emails){
  globalEmails = emails;
  generateEmailCards(globalEmails);
  addDeleteListener(globalEmails);
  addEditListener(globalEmails);
}

// Function to generate email cards from email data after fetching
function generateEmailCards(emails){
  const emailsDiv = document.getElementById('emails');
  const emailCards = emails.map(email => {
    return `
      <div class='email flex flex-col'>
        <div class='flex justify-between'>
          <div class='flex flex-col'>
            <h3>FROM: ${globalFromEmail}</h3>
            <h3>TO: ${email.to_email}</h3>
          </div>
          <div class="flex justify-between">
            <button class='${"visible-"+ email.draft}' id='${"edit-"+ email._id}'>Edit</button>
            <button id='${"delete-"+ email._id}'>Delete</button>
          </div>
        </div>
        
        
        <h4>Subject: ${email.email_subject}</h4>
        <h5 class='${"visible-"+ email.draft}'>Draft</h5>
        <p>${email.email_body}</p>
        <div class='flex flex-1 justify-between items-end'>
          <p>${email.date}</p>
          <p>${email.time}</p>
        </div>
      </div>
    `;
  });
  emailsDiv.innerHTML = emailCards.join('');
}

// Function to handle deletion of emails
function handleDelete(emailId){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('debug').innerHTML = this.responseText;
      if(this.responseText.trim() == 'Email deleted'){
        // Regenerate Emails to not have the deleted email.
        fetchEmails(generateEmails);
      }
      if(this.responseText.trim() == 'Please login to view this page'){
        window.location.href = '../Login/login.html';
      }
    }
  };
  xmlhttp.open("DELETE", "deleteEmail.php?id=" + emailId, true);
  xmlhttp.send();
}

// Function to populate the edit email form with the email data to be edited
function handleEdit(emailId){
  document.getElementById('edit-email-form').removeAttribute('hidden');
  document.getElementById('email-id').value = emailId;
  const email = globalEmails.find(email => email._id == emailId.toString());

  const emailTo = document.getElementById('email-to');
  emailTo.value = email.to_email;
  const emailSubject = document.getElementById('email-subject');
  emailSubject.value = email.email_subject;
  const emailBody = document.getElementById('email-body-editor');
  emailBody.value = email.email_body;
  tinymce.get('email-body-editor').setContent(email.email_body);
}

// Function to add event listeners to delete buttons
function addDeleteListener(emails){
  emails.forEach(email => {
    const deleteButton = document.getElementById(`delete-${email._id}`);
    deleteButton.addEventListener('click', () => {
      handleDelete(email._id);
    });
  });
}

// Function to add event listeners to edit buttons
function addEditListener(emails){
  emails.forEach(email => {
    const editButton = document.getElementById(`edit-${email._id}`);
    editButton.addEventListener('click', () => {
      handleEdit(email._id);
    });
  });
}

// Function to display any errors on the page
function displayError(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Redirect to login page if not logged in
      if(this.responseText.trim() == 'Please login to view this page'){
        window.location.href = '../Login/login.html';
      }
      document.getElementById('debug').innerHTML = this.responseText.trim();
    }
  }
  xmlhttp.open("GET", "fetchError.php", true);
  xmlhttp.send();
}

// Dark mode settings
const darkmode = localStorage.getItem('darkMode');

function darkMode(boolean){
  if(boolean){
    localStorage.setItem('darkMode', 'true');
    document.body.classList.add('dark');
  } else {
    localStorage.setItem('darkMode', 'false');
    document.body.classList.remove('dark');
  }
}

if(darkmode == 'true'){
  document.body.classList.add('dark');
  document.getElementById('darkmode').checked = true;
}
function applyDarkMode(){
  const darkmode = localStorage.getItem('darkMode');
  if(darkmode == 'true'){
    document.body.classList.add('dark');
  }
}

applyDarkMode();

window.onload = function(){
  // Adding event listeners to the dark mode toggle
  document.getElementById('darkmode').addEventListener('change', (event) => {
    console.log(event.target.checked);
    darkMode(event.target.checked);
  });

  // Adding event listeners to the cancel edit button
  document.getElementById('cancel-edit-button').addEventListener('click', () => {
    document.forms[0].reset();
    document.getElementById('edit-email-form').setAttribute('hidden', true);
  });

  // Fetch email data and display any errors
  fetchEmailStuff(setFromField);
  displayError();
}
