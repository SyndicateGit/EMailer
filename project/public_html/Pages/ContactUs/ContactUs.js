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
        } else {
          errorMessage.textContent = data.message;
        }
      })
      .catch((error) => {
        errorMessage.textContent = "An error occurred while sending the message.";
      });
  }
});
