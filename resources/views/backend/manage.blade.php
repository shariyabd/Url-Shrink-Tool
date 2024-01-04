@push('link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush
@extends('backend.layout.app')
@include('backend.loader')
@section('content')
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card card-preview p-3">
                        <div class="card-head">
                            <h3>Url List</h3>
                            <a class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="" href="javascript:void(0)" id="createUrl"> Add New <i
                                    class="fa-solid fa-plus pl-1"></i></a>
                        </div>
                
                        <div class="card-bordered card-preview px-3 py-4">
                            <div class="nk-block overflow-hidden">
                                <table class="table table-striped tablle-responsive table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Original Url</th>
                                            <th>Generated Url</th>
                                            <th>Total Visited</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Original Url</th>
                                            <th>Generated Url</th>
                                            <th>Total Visited</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    @include('backend.modal')
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('url-list') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {

                        data: 'org_url',
                        name: 'org_url'
                    },
                    {
                        data: 'short_url',
                        name: 'short_url'
                    },
                    {
                        data: 'total_view',
                        name: 'total_view'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#createUrl').click(function() {
                console.log('connect');
                $('#id').val('');
                $('#urlForm').trigger("reset");
                $('#createUrlModal').modal('show');
                $('.modal-title').html("Add Url");

            });

            $('#saveUrl').click(function(e) {
                e.preventDefault();
                $('.message').empty();

                $.ajax({
                    type: "POST",
                    url: "{{ route('url.store') }}",
                    data: $('#urlForm').serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#urlForm')[0].reset();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                toast: true,
                                title: response.success,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            // $('.data-table').load(location.href + ' .data-table');
                            table.draw();
                            $('#createUrlModal').modal('hide');
                        }
                    },
                    error: function(error) {
                        var errors = error.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.message').append('<span class="text-danger alert">' +
                                value +
                                '</span>' + '<br>');
                        })
                    }
                })

            })

            $('body').on('click', '.editBtn', function() {
                $('.message').empty();
                $('#createUrlModal').modal('show');
                $('.modal-title').html("Edit Url");
                var id = $(this).data('id');
                console.log(id);

                $.get("{{ url('/dashboard/url-edit') }}/" + id, function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('.org-url').val(data.org_url);
                });
            });


            $('body').on('click', '.urlCopybtn', function(e) {
                e.preventDefault();

                var copyText = $(this).attr('data-text');
                console.log(copyText);

            
                var textarea = document.createElement('textarea');
                textarea.value = copyText;
                document.body.appendChild(textarea);
                textarea.select();
        
                document.execCommand('copy');
                document.body.removeChild(textarea);


                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'The text has been copied to the clipboard.',
                    timer: 1000,
                    showConfirmButton: false
                });
            })


            // $('body').on('click', '.viewBtn', function() {
            //     $('.message').empty();

            //     var id = $(this).data('id');
            //     var $btn = $(this);

            //     $.get("{{ url('dashboard/url-view/') }}/" + id, function(data) {
                    
            //     });
            // });

            $(document).on('click', '.urlDelete-btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');



                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "POST",
                            url: "{{ url('dashboard/url-delete') }}/" + id,
                            data: {
                                id: id
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        toast: true,
                                        title: response.success,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    table.draw();
                                }
                            }
                        })
                    }
                })

            })

        })
    </script>
@endpush
