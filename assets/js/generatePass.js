// Declare variables
let generateBtn = document.querySelector(".generateBtn");
let passwordInput = document.querySelector(".passwordInput");

function generatePass(length = 8) {
    const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const lower = upper.toLowerCase();
    const digits = "0123456789";
    const special = "!@#$%&*?";
    const all = upper + lower + digits + special;

    let password = '';
    // Ensure at least one of each character type
    password += upper[Math.floor(Math.random() * upper.length)];
    password += lower[Math.floor(Math.random() * lower.length)];
    password += digits[Math.floor(Math.random() * digits.length)];
    password += special[Math.floor(Math.random() * special.length)];

    // Fill the rest with random characters
    for (let i = 4; i < length; i++) {
        password += all[Math.floor(Math.random() * all.length)];
    }

    // Shuffle the password to mix characters
    return password.split('').sort(() => 0.5 - Math.random()).join('');

}

generateBtn.addEventListener("click",(e)=> {
    passwordInput.value = generatePass(9);
})