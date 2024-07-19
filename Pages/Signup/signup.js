const passInput = document.getElementById("password");

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

function validPassword(password) {
    for(const key in regex) {
        if(!regex[key].test(password)) {
            return false;
        }
    }
    return true;
}

