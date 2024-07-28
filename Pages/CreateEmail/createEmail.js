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

window.onload = function() {
    // Prepopulate fields with URL params
    let params = new URLSearchParams(document.location.search);
    if (params.size > 0) {
        const to_email = params.get("to-email");
        const email_subject = params.get("email-subject");
        const email_body = params.get("email-body");

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

    xhr.send();
}; 
