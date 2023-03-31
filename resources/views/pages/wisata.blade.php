@extends('layouts.master')
@section('title', 'Tempat Wisata')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <span id="form_result_success"></span>
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-2">Tempat Wisata</h4>
            <button type="button" class="btn btn-primary align-self-center" name="create_record" id="create_record">
                <i class='bx bx-plus'></i>Tambah
            </button>
        </div>
        <div class="card mt-2">
            <div class="container mt-4 mb-4">
                <table id="wisata-table" class="table wisata_table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Harga Tiket</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sample_form" method="post">
                    <div class="modal-body">
                        <span id="form_result"></span>
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Tempat Wisata</label>
                                <input type="text" name="nama" id="nama" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea type="text" name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="harga_tiket" name="harga_tiket" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" id="action" value="Tambah" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <input type="submit" name="action_button" id="action_button" value="Tambah"
                            class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
