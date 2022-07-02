function showPassword(elem) {
    var token = document.getElementById(elem);
    if (token.type == "password") {
        token.type = "text";
        document.getElementById("hidden_" + elem).style.visibility = 'hidden';
        document.getElementById("show_" + elem).style.visibility = 'visible';
    } else {
        token.type = "password";
        document.getElementById("show_" + elem).style.visibility = 'hidden';
        document.getElementById("hidden_" + elem).style.visibility = 'visible';
    }
}

const d = document
let $btnSubmit = d.getElementById('btnSubmit'),
    $form = d.getElementById('formChangePassword'),
    $errorNewPass = d.getElementById('errorNewPassword'),
    $errorOldPass = d.getElementById('errorOldPassword'),
    $errorNewPassConfirmation = d.getElementById('errorNewPasswordConfirmation')

$form.addEventListener('keyup', e => {
    let oldPass = d.getElementById('old_password').value
    let newPass = d.getElementById('new_password').value
    let newPassConfirmation = d.getElementById('new_password_confirmation').value
    let v1 = false
    let v2 = false
    let v3 = false
    let v4 = false
    if (newPass) {
        v2 = true
            $errorNewPass.classList.add("d-none")
    } else {
        $errorNewPass.classList.remove("d-none")
        $errorNewPass.textContent = 'Ingrese un valor'
    }
    if (oldPass) {
        v1 = true
        $errorOldPass.classList.add("d-none")
    } else {
        $errorOldPass.textContent = 'Ingrese un valor'
        $errorOldPass.classList.remove("d-none")
    }
    if (newPassConfirmation) {
        v3 = true
            $errorNewPassConfirmation.classList.add("d-none")
    } else {
        $errorNewPassConfirmation.textContent = 'Ingrese un valor'
        $errorNewPassConfirmation.classList.remove("d-none")
    }
    if (newPass === newPassConfirmation) {
        v4 = true
        // $errorNewPass.classList.add('d-none')
        // $errorNewPassConfirmation.classList.add('d-none')
    } else {
        $errorNewPass.textContent = 'Las contraseñas no coinciden'
        $errorNewPass.classList.remove('d-none')
        $errorNewPassConfirmation.textContent = 'Las contraseñas no coinciden'
        $errorNewPassConfirmation.classList.remove('d-none')
    }
    if (v1 && v2 && v3 && v4) {
        $btnSubmit.classList.remove('disabled')
    }else{
        $btnSubmit.classList.add('disabled')
    }
})