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
            <th style="{{ $thStyle }}">{{ __('District') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($municipalities as $municipality)
        <tr>
            <td style="{{ $tdStyle }}">{{ $municipality->code }}</td>
            <td style="{{ $tdStyle }}">{{ $municipality->ekatte }}</td>
            <td style="{{ $tdStyle }}">{{ $municipality->name }}</td>
            <td style="{{ $tdStyle }}">{{ $municipality->district->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
