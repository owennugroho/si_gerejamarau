
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Stasi</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Nama Stasi</th>
            <th>Desa</th>
            <th>Alamat</th>
            <th>Deskripsi</th>
            <th>Umat Laki</th>
            <th>Umat Perempuan</th>
            <th>Total Umat</th>
            <th>Foto Gereja</th>
            <th>Foto Tanah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->nama_stasi }}</td>
            <td>{{ $record->desa }}</td>
            <td>{{ $record->alamat }}</td>
            <td>{{ $record->deskripsi }}</td>
            <td>{{ $record->umat_laki }}</td>
            <td>{{ $record->umat_perempuan }}</td>
            <td>{{ $record->total_umat }}</td>
            <td><img src="{{ asset($record->foto_gereja) }}" alt="Foto Gereja" width="100" height="100"></td>
            <td><img src="{{ asset($record->foto_tanah) }}" alt="Foto Tanah" width="100" height="100"></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
