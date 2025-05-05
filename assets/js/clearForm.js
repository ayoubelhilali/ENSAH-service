// Define variables
let clearBtn = document.querySelector(".clearBtn");
let nameInput = document.querySelector(".nameInput");
let prenomInput = document.querySelector(".prenomInput");
let emailInput = document.querySelector(".emailInput");
let cinInput = document.querySelector(".cinInput");
let passInput = document.querySelector(".passwordInput");

let selectinput = document.querySelectorAll(".selectInput");
let defaultOption = document.querySelectorAll(".defaultOption");

let profileImg = document.querySelector("#avatar-preview");

let inputs = [nameInput, prenomInput, emailInput, cinInput, passInput];

// Check if clear button exists
if (clearBtn) {
    clearBtn.addEventListener("click", () => {
        // Clear text inputs
        inputs.forEach(element => {
            if (element) {
                element.value = "";
            }
        });

        // Reset dropdowns to default options
        for (let i = 0; i < selectinput.length; i++) {
            if (selectinput[i] && defaultOption[i]) {
                selectinput[i].value = defaultOption[i].value || ''; // Reset to default value
                defaultOption[i].selected = true; // Mark default option as selected
            }
        }
        if (profileImg) {
            profileImg.src = "/ENSAH-service/assets/images/avatar-M.jpg";
        }
    });
} else {
    console.error("clearBtn element not found in the DOM.");
}