@extends('layouts/layoutMaster')

@section('title', 'User List - Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

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
@endsection

@section('page-script')
    {{-- <script src="{{asset('assets/js/app-user-list.js')}}"></script> --}}
@endsection

@section('content')

    <!-- Users List Table -->
    {{-- <div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 user_role"><select id="UserRole" class="form-select text-capitalize" fdprocessedid="kqdji"><option value=""> Select Role </option><option value="Admin">Admin</option><option value="Author">Author</option><option value="Editor">Editor</option><option value="Maintainer">Maintainer</option><option value="Subscriber">Subscriber</option></select></div>
      <div class="col-md-4 user_plan"><select id="UserPlan" class="form-select text-capitalize" fdprocessedid="wym6yg"><option value=""> Select Plan </option><option value="Basic">Basic</option><option value="Company">Company</option><option value="Enterprise">Enterprise</option><option value="Team">Team</option></select></div>
      <div class="col-md-4 user_status"><select id="FilterTransaction" class="form-select text-capitalize" fdprocessedid="kn2w4b"><option value=""> Select Status </option><option value="Pending" class="text-capitalize">Pending</option><option value="Active" class="text-capitalize">Active</option><option value="Inactive" class="text-capitalize">Inactive</option></select></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row mx-2"><div class="col-md-2"><div class="me-3"><div class="dataTables_length" id="DataTables_Table_0_length"><label><select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select" fdprocessedid="mtik4b"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div></div><div class="col-md-10"><div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search.." aria-controls="DataTables_Table_0"></label></div><div class="dt-buttons btn-group flex-wrap"> <div class="btn-group"><button class="btn buttons-collection dropdown-toggle btn-label-secondary mx-3" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false" fdprocessedid="0ynyjq"><span><i class="bx bx-export me-1"></i>Export</span><span class="dt-down-arrow"></span></button></div> <button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser" fdprocessedid="ta3abn"><span><i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New User</span></span></button> </div></div></div></div><table class="datatables-users table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1387px;">
      <thead>
        <tr><th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th><th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 352px;" aria-label="User: activate to sort column descending" aria-sort="ascending">User</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 176px;" aria-label="Role: activate to sort column ascending">Role</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 118px;" aria-label="Plan: activate to sort column ascending">Plan</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 216px;" aria-label="Billing: activate to sort column ascending">Billing</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 115px;" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 144px;" aria-label="Actions">Actions</th></tr>
      </thead><tbody><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-dark">BM</span></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Brockie Myles</span></a><small class="text-muted">bmylesg@amazon.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-pie-chart-alt bx-xs"></i></span>Maintainer</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-success">Active</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="ldagvn"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="xkqos8"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="lgpz3"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Gwendolyn Meineken</span></a><small class="text-muted">gmeinekenu@hc360.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Cash</td><td><span class="badge bg-label-warning">Pending</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="zoyyqf"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="sfmtk"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="kikej9"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Hugh Hasson</span></a><small class="text-muted">hhassonp@bizjournals.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Cash</td><td><span class="badge bg-label-secondary">Inactive</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="ikt2vo"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="p5j7tf"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="7kdqs8"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/3.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Kare Skitterel</span></a><small class="text-muted">kskitterelm@washingtonpost.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i class="bx bx-pie-chart-alt bx-xs"></i></span>Maintainer</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-warning">Pending</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="9i9ywc"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="cgmq4m"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="n03zr9"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Karena Courtliff</span></a><small class="text-muted">kcourtliff1a@bbc.co.uk</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-success">Active</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="hvvdr"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="nz34jl"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="n9wdp9"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-warning">MM</span></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Micaela McNirlan</span></a><small class="text-muted">mmcnirlan16@hc360.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Credit Card</td><td><span class="badge bg-label-secondary">Inactive</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="yhxlql"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="lagzp"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="a5idc"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-dark">OW</span></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Onfre Wind</span></a><small class="text-muted">owind1b@yandex.ru</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-warning">Pending</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="vdaykh"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="spoo38"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="md5qdf"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Rafaellle Snowball</span></a><small class="text-muted">rsnowballv@indiegogo.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30 me-2"><i class="bx bx-edit bx-xs"></i></span>Editor</span></td><td><span class="fw-medium">Basic</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-warning">Pending</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="wq0k7g"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="bblhhs"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="j4oz98"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/8.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Rochette Emer</span></a><small class="text-muted">remerw@blogtalkradio.com</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td><td><span class="fw-medium">Basic</span></td><td>Auto Debit</td><td><span class="badge bg-label-success">Active</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="5qbmgs"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="31j0ce8"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="mbnbq"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr><tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account" class="text-body text-truncate"><span class="fw-medium">Stu Delamaine</span></a><small class="text-muted">sdelamainek@who.int</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i class="bx bx-cog bx-xs"></i></span>Author</span></td><td><span class="fw-medium">Basic</span></td><td>Auto Debit</td><td><span class="badge bg-label-warning">Pending</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon" fdprocessedid="nzzjci"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record" fdprocessedid="vy0zo"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="g7sjvp"><i class="bx bx-dots-vertical-rounded me-2"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://127.0.0.1:8000/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr></tbody>
    </table><div class="row mx-2"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 11 entries (filtered from 50 total entries)</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm" onsubmit="return false" novalidate="novalidate">
        <div class="mb-3 fv-plugins-icon-container">
          <label class="form-label" for="add-user-fullname">Full Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" fdprocessedid="oc81fn">
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="mb-3 fv-plugins-icon-container">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" fdprocessedid="qxedc">
        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" fdprocessedid="lxxan">
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">Company</label>
          <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1" name="companyName" fdprocessedid="ocd9hl">
        </div>
        <div class="mb-3">
          <label class="form-label" for="country">Country</label>
          <div class="position-relative"><select id="country" class="select2 form-select select2-hidden-accessible" data-select2-id="country" tabindex="-1" aria-hidden="true">
            <option value="" data-select2-id="2">Select</option>
            <option value="Australia">Australia</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Belarus">Belarus</option>
            <option value="Brazil">Brazil</option>
            <option value="Canada">Canada</option>
            <option value="China">China</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Japan">Japan</option>
            <option value="Korea">Korea, Republic of</option>
            <option value="Mexico">Mexico</option>
            <option value="Philippines">Philippines</option>
            <option value="Russia">Russian Federation</option>
            <option value="South Africa">South Africa</option>
            <option value="Thailand">Thailand</option>
            <option value="Turkey">Turkey</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="United States">United States</option>
          </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 335.2px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-container"><span class="select2-selection__rendered" id="select2-country-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Select Country</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" class="form-select" fdprocessedid="trw9fj">
            <option value="subscriber">Subscriber</option>
            <option value="editor">Editor</option>
            <option value="maintainer">Maintainer</option>
            <option value="author">Author</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Select Plan</label>
          <select id="user-plan" class="form-select" fdprocessedid="yeqglb">
            <option value="basic">Basic</option>
            <option value="enterprise">Enterprise</option>
            <option value="company">Company</option>
            <option value="team">Team</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit" fdprocessedid="oqdmm7">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      <input type="hidden"></form>
    </div>
  </div>
</div> --}}
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">User List</h5>
            <div class="d-flex align-items-center row py-3 gap-3 gap-md-0">
                <div class="col-md-4 user_role"><select id="UserRole" class="form-select text-capitalize"
                        fdprocessedid="kqdji">
                        <option value=""> Select Gender </option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></div>
                <div class="col-md-4 user_status"><select id="FilterTransaction" class="form-select text-capitalize"
                        fdprocessedid="kn2w4b">
                        <option value=""> Select Status </option>
                        <option value="Pending" class="text-capitalize">Pending</option>
                        <option value="Active" class="text-capitalize">Active</option>
                        <option value="Inactive" class="text-capitalize">Inactive</option>
                    </select></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row mx-2">
                    <div class="col-md-2">
                        <div class="me-3">
                            <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                        class="form-select" fdprocessedid="mtik4b">
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
                                        class="form-control" placeholder="Search.."
                                        aria-controls="DataTables_Table_0"></label></div>
                            {{-- <div class="dt-buttons btn-group flex-wrap">
                                <div class="btn-group"><button
                                        class="btn buttons-collection dropdown-toggle btn-label-secondary mx-3"
                                        tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                        aria-haspopup="dialog" aria-expanded="false" fdprocessedid="0ynyjq"><span><i
                                                class="bx bx-export me-1"></i>Export</span><span
                                            class="dt-down-arrow"></span></button></div> <button
                                    class="btn btn-secondary add-new btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasAddUser" fdprocessedid="ta3abn"><span><i
                                            class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add
                                            New User</span></span></button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <table class="datatables-users table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
                    aria-describedby="DataTables_Table_0_info" style="width: 1387px;">
                    <thead>
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 0px; display: none;" aria-label=""></th>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1" style="width: 400px;"
                                aria-label="User: activate to sort column descending" aria-sort="ascending">User</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 224.5px;"
                                aria-label="Role: activate to sort column ascending">Phone</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 224.5px;"
                                aria-label="Plan: activate to sort column ascending">Gender</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 115px;"
                                aria-label="Status: activate to sort column ascending">Status</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 144px;"
                                aria-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><span
                                                class="avatar-initial rounded-circle bg-label-dark">BM</span></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Brockie
                                                Myles</span></a><small class="text-muted">bmylesg@amazon.com</small></div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-pie-chart-alt bx-xs"></i></span>Maintainer</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Paypal</td>
                            <td><span class="badge bg-label-success">Active</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="ldagvn"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="xkqos8"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="lgpz3"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Gwendolyn
                                                Meineken</span></a><small class="text-muted">gmeinekenu@hc360.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Cash</td>
                            <td><span class="badge bg-label-warning">Pending</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="zoyyqf"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="sfmtk"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="kikej9"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/4.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Hugh
                                                Hasson</span></a><small class="text-muted">hhassonp@bizjournals.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Cash</td>
                            <td><span class="badge bg-label-secondary">Inactive</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="ikt2vo"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="p5j7tf"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="7kdqs8"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/3.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Kare
                                                Skitterel</span></a><small
                                            class="text-muted">kskitterelm@washingtonpost.com</small></div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-pie-chart-alt bx-xs"></i></span>Maintainer</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Paypal</td>
                            <td><span class="badge bg-label-warning">Pending</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="9i9ywc"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="cgmq4m"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="n03zr9"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Karena
                                                Courtliff</span></a><small
                                            class="text-muted">kcourtliff1a@bbc.co.uk</small></div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Paypal</td>
                            <td><span class="badge bg-label-success">Active</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="hvvdr"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="nz34jl"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="n9wdp9"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><span
                                                class="avatar-initial rounded-circle bg-label-warning">MM</span></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Micaela
                                                McNirlan</span></a><small class="text-muted">mmcnirlan16@hc360.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Credit Card</td>
                            <td><span class="badge bg-label-secondary">Inactive</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="yhxlql"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="lagzp"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="a5idc"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><span
                                                class="avatar-initial rounded-circle bg-label-dark">OW</span></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Onfre
                                                Wind</span></a><small class="text-muted">owind1b@yandex.ru</small></div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Paypal</td>
                            <td><span class="badge bg-label-warning">Pending</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="vdaykh"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="spoo38"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="md5qdf"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Rafaellle
                                                Snowball</span></a><small
                                            class="text-muted">rsnowballv@indiegogo.com</small></div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30 me-2"><i
                                            class="bx bx-edit bx-xs"></i></span>Editor</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Manual - Paypal</td>
                            <td><span class="badge bg-label-warning">Pending</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="wq0k7g"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="bblhhs"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="j4oz98"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/8.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Rochette
                                                Emer</span></a><small class="text-muted">remerw@blogtalkradio.com</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30 me-2"><i
                                            class="bx bx-mobile-alt bx-xs"></i></span>Admin</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Auto Debit</td>
                            <td><span class="badge bg-label-success">Active</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="5qbmgs"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="31j0ce8"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="mbnbq"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                        <tr class="even">
                            <td class="  control" tabindex="0" style="display: none;"></td>
                            <td class="sorting_1">
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3"><img
                                                src="http://127.0.0.1:8000/assets/img/avatars/1.png" alt="Avatar"
                                                class="rounded-circle"></div>
                                    </div>
                                    <div class="d-flex flex-column"><a href="http://127.0.0.1:8000/app/user/view/account"
                                            class="text-body text-truncate"><span class="fw-medium">Stu
                                                Delamaine</span></a><small class="text-muted">sdelamainek@who.int</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-truncate d-flex align-items-center"><span
                                        class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i
                                            class="bx bx-cog bx-xs"></i></span>Author</span></td>
                            <td><span class="fw-medium">Basic</span></td>
                            <td>Auto Debit</td>
                            <td><span class="badge bg-label-warning">Pending</span></td>
                            <td>
                                <div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"
                                        fdprocessedid="nzzjci"><i class="bx bx-edit"></i></button><button
                                        class="btn btn-sm btn-icon delete-record" fdprocessedid="vy0zo"><i
                                            class="bx bx-trash"></i></button><button
                                        class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                        fdprocessedid="g7sjvp"><i class="bx bx-dots-vertical-rounded me-2"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0"><a
                                            href="http://127.0.0.1:8000/app/user/view/account"
                                            class="dropdown-item">View</a><a href="javascript:;"
                                            class="dropdown-item">Suspend</a></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mx-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            Showing 1 to 10 of 11 entries (filtered from 50 total entries)</div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                    <a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link"
                                        data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#"
                                        aria-controls="DataTables_Table_0" aria-role="link" aria-current="page"
                                        data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#"
                                        aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="1"
                                        tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                        aria-controls="DataTables_Table_0" aria-role="link" data-dt-idx="next"
                                        tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offcanvas to add new user -->
        {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
            aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                    onsubmit="return false" novalidate="novalidate">
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-fullname">Full Name</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                            name="userFullname" aria-label="John Doe" fdprocessedid="oc81fn">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="text" id="add-user-email" class="form-control"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail"
                            fdprocessedid="qxedc">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-contact">Contact</label>
                        <input type="text" id="add-user-contact" class="form-control phone-mask"
                            placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact"
                            fdprocessedid="lxxan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="add-user-company">Company</label>
                        <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                            aria-label="jdoe1" name="companyName" fdprocessedid="ocd9hl">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="country">Country</label>
                        <div class="position-relative"><select id="country"
                                class="select2 form-select select2-hidden-accessible" data-select2-id="country"
                                tabindex="-1" aria-hidden="true">
                                <option value="" data-select2-id="2">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                data-select2-id="1" style="width: 335.2px;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" role="combobox"
                                        aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                        aria-labelledby="select2-country-container"><span
                                            class="select2-selection__rendered" id="select2-country-container"
                                            role="textbox" aria-readonly="true"><span
                                                class="select2-selection__placeholder">Select Country</span></span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select" fdprocessedid="trw9fj">
                            <option value="subscriber">Subscriber</option>
                            <option value="editor">Editor</option>
                            <option value="maintainer">Maintainer</option>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="user-plan">Select Plan</label>
                        <select id="user-plan" class="form-select" fdprocessedid="yeqglb">
                            <option value="basic">Basic</option>
                            <option value="enterprise">Enterprise</option>
                            <option value="company">Company</option>
                            <option value="team">Team</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit"
                        fdprocessedid="oqdmm7">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    <input type="hidden">
                </form>
            </div>
        </div> --}}
    </div>

@endsection
