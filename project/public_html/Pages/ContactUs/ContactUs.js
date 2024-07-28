document.addEventListener("DOMContentLoaded", function () {
  const contactForm = document.getElementById("contactForm");

  // Load saved form data
  const savedFromEmail = localStorage.getItem("fromEmail");
  const savedBody = localStorage.getItem("body");

  if (savedFromEmail) {
    document.getElementById("fromEmail").value = savedFromEmail;
  }

  if (savedBody) {
    document.getElementById("body").value = savedBody;
  }

  contactForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const fromEmail = document.getElementById("fromEmail").value;
    const body = document.getElementById("body").value;
    const errorMessage = document.getElementById("errorMessage");
    const successMessage = document.getElementById("successMessage");

    if (!validateEmail(fromEmail)) {
      errorMessage.textContent = "Please enter a valid email address.";
      return;
    }

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
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          if (data.success) {
            successMessage.textContent = data.message;
            document.getElementById("contactForm").reset();
            // Clear saved data on success
            localStorage.removeItem("fromEmail");
            localStorage.removeItem("body");
          } else {
            errorMessage.textContent = data.message;
            // Save form data in localStorage
            localStorage.setItem("fromEmail", fromEmail);
            localStorage.setItem("body", body);
          }
        })
        .catch((error) => {
          errorMessage.textContent =
            "An error occurred while sending the message.";
          // Save form data in localStorage
          localStorage.setItem("fromEmail", fromEmail);
          localStorage.setItem("body", body);
        });
    }
  });
});

function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(String(email).toLowerCase());
}
