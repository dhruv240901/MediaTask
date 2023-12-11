@extends('layouts/layoutMaster')

@section('title', 'Shared Videos')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sortablejs/sortable.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/cards-actions.js') }}"></script>
    <script>
        $(document).on('keyup change', '.searchfield', function() {
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
                    search_text: $('#search').val(),
                    sharedUserList: selectedValues,
                    is_ajax: true
                },
                success: function(data) {
                    $('.sharedVideosList').html(data);
                }
            })
        });

        $(document).on('click', '.comment-btn', function() {
            $('.form-text').val('')
            $('.sharebtn').html('Add Comment')
            $('.commentId').val('');
        })

        $(document).on('click', '.editbtn', function() {
            let comment = $(this).attr('data-id');
            $('.commentId').val(comment);
            var commentName = $("#comment" + comment).contents().filter(function() {
                return this.nodeType === 3; // Filter out text nodes
            }).text().trim();
            $('.form-text').val(commentName);
            $('.sharebtn').html('Edit Comment')
        });
    </script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="position-relative">
                        <select id="selectpickerLiveSearch selectpickerSelectDeselect sharedUserList"
                            name="sharedUserList[]" class="selectpicker w-100 searchfield" data-style="btn-default"
                            data-live-search="true" multiple data-actions-box="false" data-size="5"
                            placeholder="Select User">
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
                <div class="col-md-5">
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
