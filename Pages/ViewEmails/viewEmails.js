const emailList = [
  {
    _id: '1',
    to_email: 'recipient1@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 1.',
    email_subject: 'Subject 1',
    date: '2024-07-12',
    time: '08:30'
  },
  {
    _id: '2',
    to_email: 'recipient2@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 2.',
    email_subject: 'Subject 2',
    date: '2024-07-12',
    time: '09:00'
  },
  {
    _id: '3',
    to_email: 'recipient3@example.com',
    from_email: 'sender1@example.com',
    email_body: 'Hello, this is the body of the email 3.',
    email_subject: 'Subject 3',
    date: '2024-07-12',
    time: '09:30'
  },
];

function generateEmailCards(emails){
  const emailsDiv = document.getElementById('emails');
  const emailCards = emails.map(email => {
    return `
      <div class='email flex flex-col'>
        <div class='flex justify-between'>
          <h3>${email.to_email}</h3>
          <div class="flex justify-between">
            <button id='${"edit-"+ email._id}'>Edit</button>
            <button id='${"delete-"+ email._id}'>Delete</button>
          </div>
        </div>
        
        
        <h4>${email.email_subject}</h4>
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
  console.log(`Deleting email with ID: ${emailId}`);
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

generateEmailCards(emailList);
addDeleteListener(emailList);