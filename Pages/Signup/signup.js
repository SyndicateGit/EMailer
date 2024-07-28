const passInput = document.getElementById("password");
const form = document.querySelector("form");
const errorBox = document.getElementById("errorBox");

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
    errorBox.classList.remove("visible");
    errorBox.textContent = "";
    if(!validatePassword(passInput.value)) {
        event.preventDefault();
        errorBox.textContent = "The password you have entered does not meet the requirements. Try again.";
        errorBox.classList.add("visible");
        return false;
    }
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
            const response = this.responseText.trim();
            if(response) {
                errorBox.textContent = response;
                errorBox.classList.add("visible");
            }
        }else {
            errorBox.textContent = "Signup Failed. Please try again.";
            errorBox.classList.add("visible");
        }
    };
    xmlhttp.open("GET", "userError.php", true);
    xmlhttp.send();
}; 


