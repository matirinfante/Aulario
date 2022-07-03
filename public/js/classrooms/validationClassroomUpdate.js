function validateClassroomUpdate(id) {
    // elementos
    let d = document
    let form = d.getElementById('form_classroom_edit'+id);
    let buttonUpdate = d.getElementById('submit_edit'+id);
    let inputName = d.getElementById('classroom_name_edit'+id);
    let inputCapacity = d.getElementById('capacity_edit'+id)
    // elementos de errores
    let errorName = d.getElementById('errorClassroomNameEdit'+id),
        errorCapacity = d.getElementById('errorCapacityEdit'+id)
    let v1 = false,
        v2 = false
    let reName = /^[0-9a-zA-Z ]+$/; //ExpReg solo letras, números y espacios
    console.log('ahksdh')
    // Validación name
    form.addEventListener('click', e => {
        console.log('FORM')
        if (inputName.value) {
            errorName.classList.add('d-none');
            if (reName.test(inputName.value)) {
                v1 = true;
                errorName.classList.add('d-none');
            } else {
                v1 = false;
                    errorName.textContent = 'El nombre solo puede contener letras, números y espacios';
                errorName.classList.remove('d-none');
            }
        } else {
            v1 = false;
                errorName.textContent = 'El nombre del aula está vacio';
            errorName.classList.remove('d-none');
        }
        // Validación capacity
        if (inputCapacity.value) {
            errorCapacity.classList.add('d-none');
            if (isNaN(inputCapacity.value)) {
                v2 = false;
                errorCapacity.textContent = 'La capacidad debe ser un número';
                errorCapacity.classList.remove('d-none');
            } else {                
                v2 = true;
                errorCapacity.classList.add('d-none');
            }
        } else {
            v2 = false;
                errorCapacity.textContent = 'La capacidad está vacio';
            errorCapacity.classList.remove('d-none');
        }
        if (v1 && v2) { //si se validan todos los campos se habilita el botón de envio del formulario
            buttonUpdate.classList.remove('disabled');
        } else {
            buttonUpdate.classList.add('disabled');
        }
    })
}