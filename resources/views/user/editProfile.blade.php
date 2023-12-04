@extends('layouts/layoutMaster')

@section('title', 'Edit Profile')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<script src="{{ asset('js/validation.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User /</span> Edit Profile
</h4>

<div class="row">

  <!-- Form controls -->
  <div class="col-md-6 mx-auto">
    <div class="card mb-4">
      <h5 class="card-header">Form Controls</h5>
      <div class="card-body">
        <form action="{{ route('update-user-profile') }}" method="POST" enctype="multipart/form-data" id="editProfile">
          @csrf
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Email address</label>
          <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1" value="{{auth()->user()->email}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{auth()->user()->name}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">Phone</label>
          <input type="text" class="form-control" id="exampleFormControlInput2" name="phone" value="{{auth()->user()->phone}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect1" class="form-label">Select Gender</label>
          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="gender">
            <option selected value="null">Open this select menu</option>
            <option value="Male" @if(auth()->user()->gender=="Male") selected @endif>Male</option>
            <option value="Female" @if(auth()->user()->gender=="Female") selected @endif>Female</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Select Image</label>
          <input class="form-control" type="file" id="formFile" accept="image/*" name="profile_img">
        </div>
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <a href="{{ route('user-profile') }}" class="btn btn-label-secondary">Cancel</a>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
