<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('.wisata_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('wisata') }}",
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'harga_tiket',
                    name: 'harga_tiket'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#create_record').click(function() {
            $('.modal-title').text('Tambah Data Wisata');
            $('#action_button').val('Tambah');
            $('#action').val('Tambah');
            $('#form_result').html('');
            $('#form_result_success').html('');

            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Tambah') {
                action_url = "{{ route('wisata.store') }}";
            }

            if ($('#action').val() == 'Ubah') {
                action_url = "{{ route('wisata.update') }}";
            }

            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: action_url,
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log('success: ' + data);
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success) {
                        success = '<div class="alert alert-success">' + data.success +
                            '</div>';
                        $('#sample_form')[0].reset();
                        $('#wisata-table').DataTable().ajax.reload();
                        $('#formModal').modal('hide');
                    }
                    $('#form_result').html(html);
                    $('#form_result_success').html(success);
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });

        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            $('#form_result').html('');

            $.ajax({
                url: "wisata/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                success: function(data) {
                    console.log('success: ' + data);
                    $('#nama').val(data.result.nama);
                    $('#alamat').val(data.result.alamat);
                    $('#deskripsi').val(data.result.deskripsi);
                    $('#harga_tiket').val(parseInt(data.result.harga_tiket));
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Data');
                    $('#action_button').val('Ubah');
                    $('#action').val('Ubah');
                    $('#formModal').modal('show');
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            })
        });

        var wisata_id;

        $(document).on('click', '.delete', function() {
            wisata_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "wisata/destroy/" + wisata_id,
                        success: function(data) {
                            setTimeout(function() {
                                $('#wisata-table').DataTable().ajax
                                    .reload();
                            }, 2000);
                        }
                    });

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    });
</script>

<script>
    $(document).ready(function() {
        var table = $('.u_wisata_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.wisata') }}",
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'harga_tiket',
                    name: 'harga_tiket'
                },
            ]
        });
    });
</script>
