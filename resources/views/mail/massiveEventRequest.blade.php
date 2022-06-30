@component('mail::message')
    ¡Has recibido una nueva petición de evento masivo!
    <br>
    {{$content['user']->name}} {{$content['user']->surname}} envía el siguiente mensaje:
    <p></p>
    @component('mail::panel')
        <b>{{$content['subject']}}</b>
        <p></p>
        <p>{{$content['description']}}</p>
        <p></p>
    @endcomponent

@endcomponent
