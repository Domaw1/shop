const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");

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
    event.target.classList.add("val");
}

passwordInput.oninput = (event) => {
    event.target.setCustomValidity("");
    event.target.classList.add("val");
}