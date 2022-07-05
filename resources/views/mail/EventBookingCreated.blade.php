@component('mail::message')
¡Se ha registrado tu reserva con éxito!
<br>
@component('mail::panel')
<b>Datos de la reserva:</b>
<ul>
<li><b>Fecha:</b> {{$booking->booking_date}}</li>
<li><b>Aula:</b> {{$booking->classroom->classroom_name}}</li>
<li><b>Empieza:</b> {{$booking->start_time}}</li>
<li><b>Finaliza:</b> {{$booking->finish_time}}</li>
</ul>
@endcomponent
<p></p>
<p></p>
<p>Saludos,</p>
<p>Aulario</p>
@endcomponent
