@extends('layouts.master')
@section('title', 'Tempat Wisata')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <span id="form_result_success"></span>
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-2">Tempat Wisata</h4>
        </div>
        <div class="card mt-2">
            <div class="container mt-4 mb-4">
                <table id="u-wisata-table" class="table u_wisata_table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Harga Tiket</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
