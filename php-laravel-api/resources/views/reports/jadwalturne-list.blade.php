
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Jadwal Turne</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Lokasi</th>
            <th>Tanggal</th>
            <th>Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->lokasi }}</td>
            <td>{{ $record->tanggal }}</td>
            <td>{{ $record->hari }}</td>
            <td>{{ $record->jam_mulai }}</td>
            <td>{{ $record->jam_selesai }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
