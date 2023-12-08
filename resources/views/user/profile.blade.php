@extends('layouts/layoutMaster')

@section('title', 'User Profile - Profile')

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-user-view-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">User Profile /</span> Profile
    </h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                      @if(Auth::user()->profile_image !=null)
                        <img src="{{ asset(auth()->user()->profile_image) }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                      @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=41&background=43ACF0&color=FFFFFF" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                      @endif
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ auth()->user()->name }}</h4>
                            </div>
                            <a href="{{route('user-edit',auth()->id())}}" class="btn btn-primary text-nowrap">
                                <i class='bx bx-pencil'></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span
                                class="fw-medium mx-2">Full Name:</span> <span>{{ auth()->user()->name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span
                                class="fw-medium mx-2">Email:</span> <span>{{ auth()->user()->email }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span
                                class="fw-medium mx-2">Contact:</span> <span>{{ auth()->user()->phone }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-child"></i><span
                                class="fw-medium mx-2">Gender:</span> <span>{{ auth()->user()->gender }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection
