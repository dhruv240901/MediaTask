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
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script>
        $(document).on('keyup change', '.searchfield', function() {
            // var selectedUsers = [];
            // // Display the selected values (you can use them as needed)
            // selectedUsers.push($("select[name='sharedUserList[]']").find(':selected'))
            // console.log(selectedUsers);

            var selectedValues = [];

            // Iterate through each select box
            $('.selectpicker').each(function() {
                // Get selected options in the current select box
                $(this).find('option:selected').each(function() {
                    // Push the value to the selectedValues array
                    selectedValues.push($(this).val());
                });
            });

            $.ajax({
                url: "{{ route('shared-videos') }}",
                method: 'GET',
                data: {
                    status: $('#status').val(),
                    search_text: $('#search').val(),
                    sharedUserList: selectedValues,
                    is_ajax: true
                },
                success: function(data) {
                    $('.sharedVideosList').html(data);
                }
            })
        });
    </script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="position-relative">
                        <select id="selectpickerLiveSearch selectpickerSelectDeselect sharedUserList"
                            name="sharedUserList[]" class="selectpicker w-100 searchfield" data-style="btn-default"
                            data-live-search="true" multiple data-actions-box="false" data-size="5">
                            @foreach ($otherUsers as $user)
                                @if ($user->profile_image == '')
                                    <option value="{{ $user->id }}"
                                        data-content="<img src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=30&background=696cff&color=FFFFFF' class='avatar-initial rounded-circle'>&nbsp;{{ $user->name }}">
                                        {{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}"
                                        data-content="<img src='{{ asset($user->profile_image) }}' class='rounded-circle' width='30' height='30'>&nbsp;{{ $user->name }}">
                                        {{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
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
                    <a href="{{ route('shared-videos') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Examples -->
    <div class="row mb-5 sharedVideosList">
        @include('videos.sharedVideosList')
    </div>
@endsection
