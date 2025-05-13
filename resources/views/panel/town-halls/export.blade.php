@php
    $thStyle = 'background-color: #007bff; color: #ffffff;';
    $tdStyle = '';
@endphp
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
    <thead>
        <tr>
            <th style="{{ $thStyle }}">{{ __('Code') }}</th>
            <th style="{{ $thStyle }}">{{ __('EKATTE') }}</th>
            <th style="{{ $thStyle }}">{{ __('Name') }}</th>
            <th style="{{ $thStyle }}">{{ __('Municipality') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($townHalls as $townHall)
        <tr>
            <td style="{{ $tdStyle }}">{{ $townHall->code }}</td>
            <td style="{{ $tdStyle }}">{{ $townHall->ekatte }}</td>
            <td style="{{ $tdStyle }}">{{ $townHall->name }}</td>
            <td style="{{ $tdStyle }}">{{ $townHall->municipality->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
