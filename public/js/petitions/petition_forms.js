//Formulario de comprobacion de campos de Editar(Rechazar) y Crear Peticiones
$(document).ready(function()
{
    create_comp();
    reject_comp();
    calendarDayValidate();




    function create_comp()
    {
        $("#submitRej").prop("disabled", true);
            
        let createName = document.getElementById('name');
        let createAssignment = document.getElementById('assignment_id');
        let createPeople = document.getElementById('estimated_people');
        let createClassroom = document.getElementById('classroom_type');
        let createStartDate = document.getElementById('start_date');
        let createFinishDate = document.getElementById('finish_date');
        let createStartTime = document.getElementById('start_time');
        let createFinishTime = document.getElementById('finish_time');
        let createDays = document.getElementById('days');
        let createMessage = document.getElementById('message');

        //Nombre de profesor
        if(!createName.value && createName_val == '')
        {
            $("#warning_createName").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
            $("#submit").prop("disabled", true);
        }
        else
        {
            $("#warning_createName").html('');
            $("#submit").prop("disabled", false);
        }

        //Aulas
        if(!createAssignment.value && createAssignment_val == '')
        {
            $("#warning_createAssignment").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
            $("#submit").prop("disabled", true);
        }
        else
        {
            $("#warning_createAssignment").html('');
            $("#submit").prop("disabled", false);
        }


        //Personas
        $("#warning_createPeople").html('<div class="alert alert-danger">Cantidad no valida, 2 como mínimo.</div>');
        $("#submit").prop("disabled", true);
        createPeople.addEventListener("keyup", (e) => {     
            if(createPeople.value >= 2)
            {
                $("#warning_createPeople").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createPeople").html('<div class="alert alert-danger">Cantidad no valida, 2 como mínimo.</div>');
                $("#submit").prop("disabled", true);
            }
        });


        //Aulas
        createClassroom.addEventListener("change", (e) => {
            if(createClassroom.value && createClassroom_val != '')
            {
                $("#warning_createClassroom").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createClassroom").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });

        //Start Date
        $("#warning_createStartDate").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
        $("#submit").prop("disabled", true);
        createStartDate.addEventListener("change", (e) => {
            if(createStartDate.value)
            {
                $("#warning_createStartDate").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createStartDate").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });


        //Finish Date
        $("#warning_createFinishDate").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
        $("#submit").prop("disabled", true);
        createFinishDate.addEventListener("change", (e) => {
            if(createFinishDate.value)
            {
                $("#warning_createFinishDate").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createFinishDate").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });

        //Start Time
        $("#warning_createStartTime").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
        $("#submit").prop("disabled", true);
        createStartTime.addEventListener("change", (e) => {
            if(createStartTime.value)
            {
                $("#warning_createStartTime").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createStartTime").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });

        //Finish Time
        $("#warning_createFinishTime").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
        $("#submit").prop("disabled", true);
        createFinishTime.addEventListener("change", (e) => {
            if(createFinishTime.value)
            {
                $("#warning_createFinishTime").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createFinishTime").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });


        //Dias
        createDays.addEventListener("change", (e) => {
            if(createDays.value && createDays.value != '')
            {
                $("#warning_createDays").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createDays").html('<div class="alert alert-danger">El campo no puede estar vacio.</div>');
                $("#submit").prop("disabled", true);
            }
        });


        //Mensaje
        $("#warning_createMessage").html('<div class="alert alert-danger">El campo no puede estar vacio, y debe tener al menos 8 caracteres.</div>');
        $("#submit").prop("disabled", true);
        createMessage.addEventListener("keyup", (e) => {
            const createMessage_val = createMessage.value;
            const comp = (createMessage_val != '' && createMessage_val.length > 8);
            if(comp)
            {
                $("#warning_createMessage").html('');
                $("#submit").prop("disabled", false);
            }
            else
            {
                $("#warning_createMessage").html('<div class="alert alert-danger">El campo no puede estar vacio, y debe tener al menos 8 caracteres.</div>');
                $("#submit").prop("disabled", true);
            }
        });


    }
    
    function reject_comp()
    {
        $("#submitRej").prop("disabled", true);
            
        let reason = document.getElementById('reason');
        //Mientras se levante una tecla y en el campo no haya nada escrito este muestra la alerta
        reason.addEventListener("keyup", (e) => {
            const reason_val = reason.value;
            const comp = (reason_val.length < 8);
        
            if(comp)
            {
                $("#warning_reason").html('<div class="alert alert-danger">El campo requiere al menos 8 caracteres.</div>');
                $("#submitRej").prop("disabled", true);
            }
            else
            {
                $("#warning_reason").html('');
                $("#submitRej").prop("disabled", false);
            }
        });
    }

    function calendarDayValidate() 
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
    }
});