@php
    $thStyle = 'background-color: #007bff; color: #ffffff;';
    $tdStyle = '';
@endphp
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
    <thead>
        <tr>
            <th style="{{ $thStyle }}">{{ __('EKATTE') }}</th>
            <th style="{{ $thStyle }}">{{ __('Kind') }}</th>
            <th style="{{ $thStyle }}">{{ __('Name') }}</th>
            <th style="{{ $thStyle }}">{{ __('Town Hall') }}</th>
            <th style="{{ $thStyle }}">{{ __('Municipality') }}</th>
            <th style="{{ $thStyle }}">{{ __('District') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($settlements as $settlement)
        <tr>
            <td style="{{ $tdStyle }}">{{ $settlement->ekatte }}</td>
            <td style="{{ $tdStyle }}">{{ $settlement->settlement_kind->name }}</td>
            <td style="{{ $tdStyle }}">{{ $settlement->name }}</td>
            <td style="{{ $tdStyle }}">{{ $settlement->town_hall->name }}</td>
            <td style="{{ $tdStyle }}">{{ $settlement->municipality->name }}</td>
            <td style="{{ $tdStyle }}">{{ $settlement->district->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</html>
