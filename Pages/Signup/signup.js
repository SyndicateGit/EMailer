const passInput = document.getElementById("password");
const form = document.querySelector("form");
const errorModal = document.getElementById("errorModal");

const regex = {
    minLength: /^.{10,}$/,   // Minimum 10 characters
    lowercase: /[a-z]/,      // At least one lowercase letter
    uppercase: /[A-Z]/,      // At least one uppercase letter
    digit: /\d/              // At least one digit (number)
};

passInput.addEventListener("input", () => {
    const password = passInput.value;

    if (password.length != 0) {
        passInput.classList.add('hasText');
    } else {
        passInput.classList.remove('hasText');
    }
});

form.addEventListener("submit", (event) => {
    if(!validatePassword(passInput.value)) {
        event.preventDefault();
        alert("The password you have entered does not meet the requirements. Try again.");
        return false;
    }
    errorModal.classList.remove("visible");
    errorModal.textContent = "";
});

function validatePassword(password) {
    for(const key in regex) {
        if(!regex[key].test(password)) {
            return false;
        }
    }
    return true;
}

window.onload = function() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const response = this.responseText;
        if(response) {
            errorModal.textContent = response;
            errorModal.classList.add("visible");
        }
      }
    };
    xmlhttp.open("GET", "userError.php", true);
    xmlhttp.send();
}; 


