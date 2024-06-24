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
        @foreach ($townHalls as $town_hall)
        <tr>
            <td style="{{ $tdStyle }}">{{ $town_hall->code }}</td>
            <td style="{{ $tdStyle }}">{{ $town_hall->ekatte }}</td>
            <td style="{{ $tdStyle }}">{{ $town_hall->name }}</td>
            <td style="{{ $tdStyle }}">{{ $town_hall->municipality->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
