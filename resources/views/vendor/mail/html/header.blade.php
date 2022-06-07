<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Aulario')
<img src="{{asset('assets/img/aulario.png')}}" class="logo" alt="Aulario">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
