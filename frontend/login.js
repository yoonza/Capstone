const loginForm = document.getElementById("login-form");
const loginButton = document.getElementById("login-form-submit");
const loginErrorMsg = document.getElementById("login-error-msg");

loginButton.addEventListener("click", (event) => {
    event.preventDefault();
    const username = loginForm.username.value;
    const password = loginForm.password.value;

    if (username === "user" && password === "1234") {
        alert("안녕하세요, 회원님! 오늘도 행복한 하루되세요.");
        location.reload();
    } else {
        loginErrorMsg.style.opacity = 1;
    }
});