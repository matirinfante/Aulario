<tr>
<td class="header">
<a href="https://aulario.fi.uncoma.edu.ar" style="display: inline-block;">
@if (trim($slot) === 'Aulario')
<img src="https://aulario.fi.uncoma.edu.ar/assets/img/aulario.png" style="width: 30%; height: auto">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
