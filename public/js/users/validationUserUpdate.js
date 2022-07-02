function validarUserUpdate(id) {
    // elementos
    let d = document
    let form = d.getElementById('formUserUpdate' + id);
    let inputName = d.getElementById('userNameUpdate' + id);
    let inputSurname = d.getElementById('userSurnameUpdate' + id);
    let inputDni = d.getElementById('userDniupdate' + id);
    let inputEmail = d.getElementById('userEmailUpdate' + id);
    let buttonUpdate = d.getElementById('btnUserSubmit' + id);
    // elementos de errores
    let errorName = d.getElementById('errorUserNameUpdate' + id);
        errorSurname = d.getElementById('errorUserSurnameUpdate' + id),
        errorDni = d.getElementById('errorUserDniUpdate' + id),
        errorEmail = d.getElementById('errorUserEmailUpdate' + id)
    let v1 = false,
        v2 = false,
        v3 = false,
        v4 = false
    let reName = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/; //ExpReg solo letras y espacios
    let reEmail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{1,63}$/i; //ExpReg email valido ejemplo@mail.extensión
    // Validación name
    form.addEventListener('click', e => {
        if (inputName.value) {
            errorName.classList.add('d-none');
            if (reName.test(inputName.value)) {
                v1 = true;
                errorName.classList.add('d-none');
            } else {
                v1 = false,
                    errorName.textContent = 'El nombre solo puede contener letras y espacios';
                errorName.classList.remove('d-none');
            }
        } else {
            v1 = false,
                errorName.textContent = 'El nombre está vacio';
            errorName.classList.remove('d-none');
        }
        // Validación surname
        if (inputSurname.value) {
            errorSurname.classList.add('d-none');
            if (reName.test(inputSurname.value)) {
                v2 = true;
                errorSurname.classList.add('d-none');
            } else {
                v2 = false,
                    errorSurname.textContent = 'El apellido solo puede contener letras y espacios';
                errorSurname.classList.remove('d-none');
            }
        } else {
            v2 = false,
                errorSurname.textContent = 'El apellido está vacio';
            errorSurname.classList.remove('d-none');
        }
        // Validación dni
        if (inputDni.value) {
            errorDni.classList.add('d-none');
            if (!isNaN(inputDni.value) && ((inputDni.value).length > 6 && (inputDni.value).length < 9)) {
                v3 = true;
                errorDni.classList.add('d-none');
            } else {
                v3 = false,
                    errorDni.textContent = 'El dni debe ser un número de 7 u 8 dígitos';
                errorDni.classList.remove('d-none');
            }
        } else {
            v3 = false,
                errorDni.textContent = 'El dni está vacio';
            errorDni.classList.remove('d-none');
        }
        // Validación email
        if (inputEmail.value) {
            errorEmail.classList.add('d-none');
            if (reEmail.test(inputEmail.value)) {
                v4 = true;
                errorEmail.classList.add('d-none');
            } else {
                v4 = false,
                    errorEmail.textContent = 'El email no es valido';
                errorEmail.classList.remove('d-none');
            }
        } else {
            v4 = false,
                errorEmail.textContent = 'El email está vacio';
            errorEmail.classList.remove('d-none');
        }
        if (v1 && v2 && v3 && v4) { //si se validan todos los campos se habilita el envio del formulario
            buttonUpdate.classList.remove('disabled')
        } else {
            buttonUpdate.classList.add('disabled')
        }
    })
}