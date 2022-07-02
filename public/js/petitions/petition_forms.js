//Formulario de comprobacion de campos de Editar(Rechazar) y Crear Peticiones
 $(document).ready(function()
 {

    let start_date = document.getElementById("start_date");
    let finish_date = document.getElementById("finish_date");
    //Obtiene la fecha actual y luego le da formato 'YYYY-MM-DD'
    //Estos metodos no agregan cero a numero menores a 10, como por ejemplo '5'(mayo), y no 05
    const fullDate = new Date();
    const year = fullDate.getFullYear();
    let month = fullDate.getMonth();
    let day = fullDate.getDate();
    month += 1; //La fecha el metodo .getMonth la trae de 0 a 11, se debe sumar 1
    if (month < 10) {
        month = '0' + month;
    }

    if (day < 10) {
        day = '0' + day;
    }

    //Concatenamos la fecha en el formato correcto
    const date = year + '-' + month + '-' + day;
    //Elementos a los que quiero limitarle la seleccion
    start_date.setAttribute('min', date);
    finish_date.setAttribute('min', date);



    reject_comp();


        
    //$("#warning_reason").html(`<div class="alert alert-warning">Es necesario explicar la razón del rechazo.</div>`);


     function reject_comp()
     {
        let reason = document.getElementById('reason');
        //Mientras se levante una tecla y en el campo no haya nada escrito este muestra la alerta
        reason.addEventListener("keyup", (e) => {
            const reason_val = reason.value;
            const comp = (reason_val == '');

            //console.log(reason_val);

            if(comp)
            {
                $("#warning_reason").html('<div class="alert alert-warning">Es necesario explicar la razón del rechazo.</div>');
            }

        });
    }
 });