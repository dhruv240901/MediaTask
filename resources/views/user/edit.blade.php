@extends('layouts/layoutMaster')

@section('title', 'Edit Profile')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<script src="{{ asset('js/validation.js') }}"></script>
<script>
  $(document).ready(function(){
    $('#removebtn').click(function(){
      $('#profile_img').remove()
      $(this).remove()
    })
  })
</script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">User /</span> Edit User
</h4>

<div class="row">

  <!-- Form controls -->
  <div class="col-md-6 mx-auto">
    <div class="card mb-4">
      <h5 class="card-header">Edit User</h5>
      <div class="card-body">
        <form action="{{ route('user-update',$user->id) }}" method="POST" enctype="multipart/form-data" id="editProfile">
          @method('PUT')
          @csrf
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Email address</label>
          <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1" value="{{$user->email}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="{{old('name',$user->name)}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput2" class="form-label">Phone</label>
          <input type="text" class="form-control" id="exampleFormControlInput2" name="phone" value="{{old('phone',$user->phone)}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect1" class="form-label">Select Gender</label>
          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="gender">
            <option selected value="">Open this select menu</option>
            <option value="male" @if($user->gender=="male") selected @endif>Male</option>
            <option value="female" @if($user->gender=="female") selected @endif>Female</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="formFile" class="form-label">Select Image</label>
          <input class="form-control" type="file" id="formFile" accept="image/*" name="profile_img">
        </div>
        @if($user->profile_image!=null)
        <div class="mb-3" id="profile_img">
         <img src="{{ asset($user->profile_image) }}">
         <input class="form-control" type="hidden" id="formFile" value="{{ $user->profile_image }}" name="profile_img_url">
        </div>
        <div class="mb-3">
          <button type="button" class="btn btn-danger" id="removebtn">Remove</button>
        </div>
        @endif
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <a href="{{ route('user-list') }}" class="btn btn-label-secondary">Cancel</a>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
