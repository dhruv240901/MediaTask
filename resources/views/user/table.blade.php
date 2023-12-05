@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css')}}" />@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js')}}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
    <script>
      $('.searchfield').change(function(){
          $.ajax({
            url:"{{ route('user-list') }}",
            method:'GET',
            data:{
              gender:$('#UserGender').val(),
              status:$('#UserStatus').val(),
              limit:$('#limit').val(),
              search_text:$('#search_input').val(),
              order:$('#NameOrder').val(),
              is_ajax:true
            },
            success: function(data){
              $('#userdetails').html(data)
            }
          })
      })

    $('.user-status').on('change', function() {
        const id = $(this).data('id');
        const isChecked = $(this).is(':checked');

        $.ajax({
            type: 'POST',
            url: '{{route('update-user-status')}}',
            data: {
                id:id,
                checked: isChecked,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                if(response.status == 200){
                    toastr.success(""+response.message+"");
                }else{
                    toastr.error(""+response.message+"");
                }
            },
        });
    });
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">User List</h5>
            <div class="d-flex align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role"><select id="UserGender" class="form-select text-capitalize searchfield"
                        fdprocessedid="kqdji">
                        <option value=""> Select Gender </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select></div>
                <div class="col-md-4 user_status"><select id="UserStatus" class="form-select text-capitalize searchfield"
                        fdprocessedid="kn2w4b">
                        <option value=""> Select Status </option>
                        <option value="1" class="text-capitalize">Active</option>
                        <option value="0" class="text-capitalize">Inactive</option>
                    </select></div>
                <div class="col-md-4 user_status"><select id="NameOrder" class="form-select text-capitalize searchfield"
                      fdprocessedid="kn2w4b">
                      <option value=""> Select Order </option>
                      <option value="ASC" class="text-capitalize">Ascending</option>
                      <option value="DESC" class="text-capitalize">Descending</option>
                  </select></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row mx-2">
                    <div class="col-md-2">
                        <div class="me-3">
                            <div class="dataTables_length" ><label><select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                        class="form-select searchfield" fdprocessedid="mtik4b" id="limit">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select></label></div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div
                            class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search"
                                        class="form-control searchfield" placeholder="Search.."
                                        aria-controls="DataTables_Table_0" id="search_input"></label></div>
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
                    aria-describedby="DataTables_Table_0_info" style="width: 1387px;">
                    <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 0px; display: none;" aria-label=""></th>
                            <th class="sorting sorting_asc namesort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 400px;" aria-label="User: activate to sort column descending"
                                aria-sort="ascending">User</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 224.5px;" aria-label="Role: activate to sort column ascending">
                                Phone</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 224.5px;" aria-label="Plan: activate to sort column ascending">
                                Gender</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 115px;" aria-label="Status: activate to sort column ascending">
                                Status</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 144px;"
                                aria-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userdetails">
                      @include('user.list')
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
