
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>Inventaris</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Lokasi Barang</th>
            <th>Kode Barang</th>
            <th>Kategori Barang</th>
            <th>Tanggal Memperoleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->nama_barang }}</td>
            <td>{{ $record->lokasi_barang }}</td>
            <td>{{ $record->kode_barang }}</td>
            <td>{{ $record->kategori_barang }}</td>
            <td>{{ $record->tanggal_memperoleh }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
