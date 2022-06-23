//Formulario de comprobacion de campos de Editar(Rechazar) y Crear Peticiones
//  $(documento).ready(function()
//  {
    $("#warning_reason").html(`<div class="alert alert-warning">Es necesario explicar la razón del rechazo.</div>`);

     function reject_comp() 
     {
        let reason = document.getElementById('reason');
        //Mientras se levante una tecla y en el campo no haya nada escrito este muestra la alerta
        reason.addEventListener("submit", (e) => {
            const reason_val = reason.value();
            const comp = (reason_val == '');

            console.log(reason_val);

            if(comp)
            {
                $("#warning_reason").html('<div class="alert alert-warning">Es necesario explicar la razón del rechazo.</div>');
            }
            
        });
    }

//  });