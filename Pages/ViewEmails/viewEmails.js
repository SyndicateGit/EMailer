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
      <div class="email">
        <h2>${email.to_email}</h2>
        <h3>${email.email_subject}</h3>
        <p>${email.email_body}</p>
        <div class='flex justify-between'>
          <p>${email.date}</p>
          <p>${email.time}</p>
        </div>
      </div>
    `;
  });
  emailsDiv.innerHTML = emailCards.join('');
}

generateEmailCards(emailList);