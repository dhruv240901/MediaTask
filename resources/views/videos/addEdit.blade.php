@extends('layouts/layoutMaster')

@section('title', 'File upload - Forms')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Forms /</span> File upload
    </h4>

    <div class="row">
        <!-- Basic  -->
        {{-- <form action="{{ route('store-videos') }}" method="POST" enctype="multipart/form-data"> --}}
        <div class="my-2">
            <label for="defaultFormControlInput" class="form-label">Name</label>
            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe"
                aria-describedby="defaultFormControlHelp">
        </div>
        <div class="col-12 my-3">
            <div class="card mb-4">
                <h5 class="card-header">Upload Video</h5>
                <div class="card-body">
                    <form action="{{ route('store-videos') }}" method="POST" class="dropzone needsclick"
                        id="dropzone-basic" enctype="multipart/form-data">
                        @csrf
                        <div class="dz-message needsclick">
                            Drop files here or click to upload
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are <span
                                    class="fw-medium">not</span> actually uploaded.)</span>
                        </div>
                        <div class="fallback">
                            <input name="video" type="file" value="abc" />
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Basic  -->
        {{-- </form> --}}
    </div>
@endsection
