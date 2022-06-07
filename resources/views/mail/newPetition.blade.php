@component('mail::message')
¡Has recibido una nueva petición!
<br>
@component('mail::panel')
    ¿Quién? {{$petition->user->name}} {{$petition->user->surname}} solicita un aula de tipo {{$petition->classroom_type}}
    para una capacidad estimada de alumnos de {{$petition->estimated_people}}
@endcomponent
<br>
¿Qué materia? {{$petition->assignment->assignment_name}}
<br>
¿Qué horario? Entre {{$petition->start_time}} hrs y {{$petition->finish_time}} para el día {{$petition->days}}

@component('mail::button', ['url' => 'test'])
Ver mas
@endcomponent
@endcomponent
