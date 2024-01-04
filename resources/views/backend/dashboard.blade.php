@extends('backend.layout.app')
@section('content')
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-8">
                <div class="card shadow-sm p-3">
                    <div class="message px-3 pt-2"></div>
                    <form id="urlForm">
                        @csrf
                        <div class="form-group">
                            <label for="org_url">Url:</label>
                            <div class="d-flex input-group mb-3">
                                <input type="text" name="org_url" id="org_url" class="form-control"
                                    placeholder="Original Url" aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-primary generate" type="submit" onclick="addInputField()"
                                    id="button-addon2">Generate</button>
                            </div>
                            <div id="input-container" class="d-flex input-group mb-3"></div>
                        </div>
                        <div class="form-group" id="shorten" style="display: none">
                            <label for="shorten_url">Generated New Url:</label>
                            <div class="d-flex input-group mb-3">
                                <input type="text" id="short_url" class="form-control" placeholder="Shorten Url"
                                    aria-label="Shorten" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="" id="button-addon2">Copy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   @include('backend.loader')
    @if (Session::has('success'))
        @push('js')
            <script>
                Swal.fire({
                    showConfirmButton: false,
                    position: 'top-end',
                    icon: 'success',
                    toast: true,
                    title: '{{ Session::get('success') }}',
                    timer: 2500
                });
            </script>
        @endpush
    @endif
@endsection
@push('js')
   
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var existingInputField = null;
        var orgUrl = document.getElementById('org_url');

        function addInputField(shortUrl) {


            if (existingInputField) {
                existingInputField.val(shortUrl);
            } else {

                var inputGroup = $('<div class="d-flex input-group mb-3">');
                existingInputField = $(
                    '<input type="text" name="" class="form-control" id="short_url" placeholder="Shorten Url">'
                );

                existingInputField.val(shortUrl);
                var generateButton = $(
                    '<button class="btn btn-primary copy" type="button"><i class="fa-solid fa-copy"></i></button>');

                inputGroup.append(existingInputField);
                inputGroup.append(generateButton);
                $('#input-container').append(inputGroup);
            }
        }



        $(document).ready(function() {
            $('.generate').click(function(e) {
                e.preventDefault();
                $('.message').empty();

                $.ajax({
                    type: "POST",
                    url: "{{ route('url.store') }}",
                    data: $('#urlForm').serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#urlForm')[0].reset();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                toast: true,
                                title: response.success,
                                showConfirmButton: false,
                                timer: 2500
                            });

                            addInputField(response.data.short_url);

                        }

                    },
                    error: function(error) {
                        var errors = error.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('.message').append(
                                '<span class="text-danger alert">' +
                                value +
                                '</span>' + '<br>'
                            );

                        });
                    }
                });
            });
        });



        $(document).on('click', '.copy', function() {
            var copyText = document.getElementById("short_url");


            if (copyText.value.trim() === '') {

                console.error('Input field is empty');
                return;
            }

            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value)
                .then(function() {

                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'The text has been copied to the clipboard.',
                        timer: 1000,
                        showConfirmButton: false
                    });
                })
                .catch(function(err) {
                    console.error('Unable to copy to clipboard', err);

                });
        });
    </script>
@endpush
