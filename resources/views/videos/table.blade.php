@extends('layouts/layoutMaster')

@section('title', 'Cards basic - UI elements')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
@endsection

@section('page-script')
    @include('components.toastr')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script>
        $(document).on('keyup change', '.searchfield', function() {
            $.ajax({
                url: "{{ route('my-videos') }}",
                method: 'GET',
                data: {
                    status:$('#status').val(),
                    search_text: $('#search').val(),
                    is_ajax: true
                },
                success: function(data) {
                    $('.videodetails').html(data)
                }
            })
        })
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
                    <input type="text" name='search' class="form-control searchfield" id="search" placeholder="Search"
                        value="" />
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
