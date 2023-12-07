@extends('layouts/layoutMaster')

@section('title', 'Cards basic - UI elements')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
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
    const shareusersList = ["@foreach ($otherUsers as $user){value: 1,name: 'Justinian Hattersley', avatar: 'https://i.pravatar.cc/80?img=1',email: 'jhattersley0@ucsd.edu'},@endforeach"]
    console.log(shareusersList)
        $(document).on('keyup', '#search_input', function() {
            $.ajax({
                url: "{{ route('my-videos') }}",
                method: 'GET',
                data: {
                    search_text: $(this).val(),
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
    <h4 class="py-3 mb-4">Videos List</h4>
    <div class="row mx-2 mb-3">
        <div class="col-md-2">
            <div class="me-3">
                <a href="{{ route('add-videos') }}" class="btn btn-primary">+Add Video</a>
            </div>
        </div>
        <div class="col-md-10">
            <div
                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                            class="form-control searchfield" placeholder="Search.." aria-controls="DataTables_Table_0"
                            id="search_input"></label></div>
            </div>
        </div>
    </div>
    <div class="row mb-5 videodetails">
        @include('videos.list')
    </div>
@endsection
