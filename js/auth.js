const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const form = document.querySelector(".form-control");

emailInput.oninvalid = (event) => {
    event.target.setCustomValidity("");
    if(!event.target.value.valid){
        event.target.setCustomValidity(event.target.value ? "Некорректная почта!" : "Это поле не может оставаться пустым!");
    }
}

passwordInput.oninvalid = (event) => {
    event.target.setCustomValidity("");
    if(!event.target.value.valid){
        event.target.setCustomValidity("Это поле не может оставаться пустым!");
    }
}

emailInput.oninput = (event) => {
    event.target.setCustomValidity("");
}

passwordInput.oninput = (event) => {
    event.target.setCustomValidity("");
}

form.addEventListener("focusout", (event) => {
    event.target.classList.add("val");
});