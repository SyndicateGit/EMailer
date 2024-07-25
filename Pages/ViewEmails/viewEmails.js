const emailList = [
  {
    _id: '1',
    user: '1',
    to_email: 'recipient1@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 1.',
    email_subject: 'Subject 1',
    is_draft: false,
    date: '2024-07-12',
    time: '08:30'
  },
  {
    _id: '2',
    user: '1',
    to_email: 'recipient2@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 2.',
    email_subject: 'Subject 2',
    is_draft: true,
    date: '2024-07-12',
    time: '09:00'
  },
  {
    _id: '3',
    user: '1',
    to_email: 'recipient3@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 3.',
    email_subject: 'Subject 3',
    date: '2024-07-12',
    is_draft: false,
    time: '09:30'
  },
];

var globalFromEmail;

function fetchEmailStuff(callback) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var from_email = '' + this.responseText;
      setFromField(from_email);
    } else{
      console.log("Error fetching from email");
    }
  };
  xmlhttp.open("GET", "fetchFromEmail.php", true);
  xmlhttp.send();
}

function setFromField(from_email){
  globalFromEmail = from_email;
  fetchEmails(generateEmails);
}

var globalEmails;

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
            <button class='${"visible-"+ email.is_draft}' id='${"edit-"+ email._id}'>Edit</button>
            <button id='${"delete-"+ email._id}'>Delete</button>
          </div>
        </div>
        
        
        <h4>Subject: ${email.email_subject}</h4>
        <h5 class='${"visible-"+ email.is_draft}'>Draft</h5>
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

function handleDelete(emailId){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('debug').innerHTML = this.responseText;
      if(this.responseText.trim() == 'Email deleted'){
        // Regenerate Emails to not have the deleted email.
        fetchEmails(generateEmails);
      }
    }
  };
  xmlhttp.open("DELETE", "deleteEmail.php?id=" + emailId, true);
  xmlhttp.send();
}

function handleEdit(emailId){
  console.log(`Editing email with ID: ${emailId}`);
}

function addDeleteListener(emails){
  emails.forEach(email => {
    const deleteButton = document.getElementById(`delete-${email._id}`);
    deleteButton.addEventListener('click', () => {
      handleDelete(email._id);
    });
  });
}

function addEditListener(emails){
  emails.forEach(email => {
    const editButton = document.getElementById(`edit-${email._id}`);
    editButton.addEventListener('click', () => {
      handleEdit(email._id);
    });
  });
}

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

fetchEmailStuff(setFromField);



