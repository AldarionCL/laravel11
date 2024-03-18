<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    @if (trim($slot) === 'ROMA')
        <img src="{{ asset('assets/img/logo-roma-azul.svg') }}" class="logo" alt="ROMA Logo">
    @else
{{ $slot }}
@endif
</a>
</td>
</tr>
