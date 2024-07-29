// Add event listener to the contact form to handle form submission
document.getElementById("contactForm").addEventListener("submit", function (event) {
  event.preventDefault();

  const fromEmail = document.getElementById("fromEmail").value;
  const body = document.getElementById("body").value;
  const errorMessage = document.getElementById("errorMessage");

  if (!fromEmail || !body) {
    errorMessage.textContent = "Both email and message are required.";
  } else {
    errorMessage.textContent = "";

    const formData = new FormData();
    formData.append("from_email", fromEmail);
    formData.append("email_body", body);

    fetch("contactus.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then((data) => {
        if (data.success) {
          errorMessage.textContent = data.message;
          document.getElementById("contactForm").reset();
          localStorage.removeItem("fromEmail");
          localStorage.removeItem("body");
        } else {
          errorMessage.textContent = data.message;
          localStorage.setItem("fromEmail", fromEmail);
          localStorage.setItem("body", body);
        }
      })
      .catch((error) => {
        errorMessage.textContent = "An error occurred while sending the message.";
      });
  }
});

// Load saved form data
const savedFromEmail = localStorage.getItem("fromEmail");
const savedBody = localStorage.getItem("body");

if (savedFromEmail) {
  document.getElementById("fromEmail").value = savedFromEmail;
}

if (savedBody) {
  document.getElementById("body").value = savedBody;
}