@extends('layouts/layoutMaster')

@section('title', 'My Videos')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sortablejs/sortable.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
    @include('components.toastr')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{asset('assets/js/cards-actions.js')}}"></script>
    <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('keyup change', '.searchfield', function() {
                $.ajax({
                    url: "{{ route('my-videos') }}",
                    method: 'GET',
                    data: {
                        status: $('#status').val(),
                        search_text: $('#search').val(),
                        is_ajax: true
                    },
                    success: function(data) {
                        $('.videodetails').html(data)
                    }
                })
            });
            // TODO: Update user name and profile image if user has updated in google account
            // $(document).on('submit', '.shareuserform', function(e) {
            //     e.preventDefault()
            //     Swal.fire({
            //         title: "Are you sure?",
            //         text: "You won't to share this video!",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "Yes, share it!"
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var currentForm = $(this).attr('id');
            //             $('#' + currentForm).unbind('submit').submit();
            //         }
            //     });
            // });
        });
    </script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-7">
                    <a href="{{ route('add-videos') }}" class="btn btn-primary">+Add Video</a>
                </div>
                <div class="col-md-2 text-md-end">
                    <select class="form-select searchfield" id="status" aria-label="Default select example">
                        <option selected value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-end">
                    <input type="text" name='search' class="form-control searchfield" id="search"
                        placeholder="Search" value="" />
                </div>
                <div class="col-md-1 text-md-end">
                    <a href="{{ route('my-videos') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5 videodetails">
        @include('videos.list')
    </div>


@endsection
