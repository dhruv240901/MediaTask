@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    @include('components.toastr')
    <script>
        $(document).ready(function() {

            $(document).on('change keyup', '.searchfield', function() {
                $.ajax({
                    url: "{{ route('user-list') }}",
                    method: 'GET',
                    data: {
                        gender: $('#UserGender').val(),
                        status: $('#UserStatus').val(),
                        limit: $('#limit').val(),
                        search_text: $('#search_input').val(),
                        order: $('#NameOrder').val(),
                        is_ajax: true
                    },
                    success: function(data) {
                        $('.userdetails').html(data)
                    }
                })
            })

            $(document).on('change', '.user-status', function() {
                console.log('grtg')
                const id = $(this).data('id');
                const isChecked = $(this).is(':checked');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-user-status') }}',
                    data: {
                        id: id,
                        checked: isChecked,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 200) {
                            toastr.success("" + response.message + "");
                        } else {
                            toastr.error("" + response.message + "");
                        }
                    },
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">User List</h5>
            <div class="d-flex align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-2 user_role"><select id="UserGender" class="form-select text-capitalize searchfield"
                        fdprocessedid="kqdji">
                        <option value=""> Select Gender </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select></div>
                <div class="col-md-2 user_status"><select id="UserStatus" class="form-select text-capitalize searchfield"
                        fdprocessedid="kn2w4b">
                        <option value=""> Select Status </option>
                        <option value="1" class="text-capitalize">Active</option>
                        <option value="0" class="text-capitalize">Inactive</option>
                    </select></div>
                <div class="col-md-2 user_status"><select id="NameOrder" class="form-select text-capitalize searchfield"
                        fdprocessedid="kn2w4b">
                        <option value="ASC" class="text-capitalize">Ascending</option>
                        <option value="DESC" class="text-capitalize">Descending</option>
                    </select></div>
                <div class="col-md-2">
                    <div class="me-3">
                        <div class="dataTables_length"><label><select name="DataTables_Table_0_length"
                                    aria-controls="DataTables_Table_0" class="form-select searchfield"
                                    fdprocessedid="mtik4b" id="limit">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select></label></div>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                  <div
                      class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                      <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                                  class="form-control searchfield" placeholder="Search.."
                                  aria-controls="DataTables_Table_0" id="search_input"></label></div>
                  </div>
              </div>
              <div class="col-md-1 text-md-end">
                <a href="{{ route('user-list') }}" class="btn btn-danger">Cancel</a>
              </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer userdetails">
                @include('user.list')
            </div>
        </div>
    </div>
@endsection
