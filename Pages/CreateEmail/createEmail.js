const emailSubject = document.getElementById("email-subject");
const emailRecipient = document.getElementById("to-email");
const form = document.querySelector("form");
const errorModal = document.getElementById("error-modal");

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

const darkmode = localStorage.getItem('darkMode');
if(darkmode == 'true'){
  document.body.classList.add('dark');
};

function validateField(inputField) {
  const parent = inputField.parentNode;
  const warningModal = parent.getElementsByClassName("validation-modal")[0];
  const userInput = inputField.value;

  if (userInput.length === 0) {
    warningModal.style.visibility = "visible";
    return false;
  }

  warningModal.style.visibility = "hidden";
  return true;
}

form.addEventListener("submit", (event) => {

  const recipient = emailRecipient.value;
  const subject = emailSubject.value;

  if (recipient.length === 0 || subject.length === 0) {
    event.preventDefault();
  }
  
  const recipientIsValid = validateField(emailRecipient);
  const subjectIsValid = validateField(emailSubject);

  if (!recipientIsValid || !subjectIsValid) {
    errorModal.innerHTML = "Email not sent: please ensure all required fields are filled.";
    errorModal.style.visibility = "visible";
  }
})

window.onload = function() {
    // Prepopulate fields with URL params
    let params = new URLSearchParams(document.location.search);
    if (params.size > 0) {
        to_email = params.get("to-email");
        email_subject = params.get("email-subject");
        email_body = params.get("email-body");

        if (to_email) {
            document.getElementById("to-email").value = to_email;
        }
        if (email_subject) {
            document.getElementById("email-subject").value = email_subject;
        }
        if (email_body) {
            // document.getElementById("email-body-editor").value = email_body;
            tinymce.activeEditor.setContent(email_body);
        }
    }

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "sendError.php", true);
    xhr.onload = () => {
      if (xhr.readyState === xhr.DONE) {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if(response.length > 0) {
            errorModal.innerHTML = response;
            errorModal.style.visibility = "visible";
          }
        }
      }
    };

    xhr.send(null);
}; 


