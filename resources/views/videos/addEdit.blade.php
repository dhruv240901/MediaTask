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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <script src="{{ asset('js/validation.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Forms /</span> File upload
    </h4>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">{{ isset($video) && $video != null ? 'Edit' : 'Add' }} Video</h5>
                <div class="card-body">
                    <form
                        action="{{ isset($video) && $video != null ? route('update-video', $video->id) : route('store-videos') }}"
                        method="POST" enctype="multipart/form-data"
                        id={{ isset($video) && $video != null ? 'editvideoform' : 'addvideoform' }}>
                        @if (isset($video) && $video != null)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name"
                                value="{{ $video->name ?? old('name') }}" />
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Select Video</label>
                            <input class="form-control" type="file" id="formFile" accept="video/*" name="video">
                        </div>
                        <div class="mb-3">
                            @if (isset($video) && $video != null)
                                <img src="{{ asset('user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/' . $video->file_name . '.jpg') }}"
                                    width="100px" height="100px">
                            @endif
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck3" name="is_active"
                                value="1" @if (isset($video) && $video->is_active == true) checked @endif>
                            <label class="form-check-label" for="defaultCheck3">
                                Active
                            </label>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <a href="{{ route('my-videos') }}" class="btn btn-label-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
