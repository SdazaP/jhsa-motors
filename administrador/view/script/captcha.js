function showCaptcha() {
    var captcha = Math.floor(Math.random() * 90000) + 10000;
    var userResponse = prompt("Por favor ingresa este número para continuar: " + captcha);
    if (userResponse !== null) {
        document.getElementById('captcha').value = userResponse;
        document.getElementById('real_captcha').value = captcha;
    }
}