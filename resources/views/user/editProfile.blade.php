@extends('layouts/layoutMaster')

@section('title', 'Edit Profile')

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
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
        <form>
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Email address</label>
          <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1" value="{{auth()->user()->email}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->name}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Phone</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->phone}}" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInput1" class="form-label">Read only</label>
          <input class="form-control" type="text" id="exampleFormControlReadOnlyInput1" placeholder="Readonly input here..." readonly />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlReadOnlyInputPlain1" class="form-label">Read plain</label>
          <input type="text" readonly class="form-control-plaintext" id="exampleFormControlReadOnlyInputPlain1" value="email@example.com" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect1" class="form-label">Select Gender</label>
          <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="Male" @if(auth()->user()->gender=="Male") selected @endif>Male</option>
            <option value="Female" @if(auth()->user()->gender=="Female") selected @endif>Female</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="exampleDataList" class="form-label">Datalist example</label>
          <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
          <datalist id="datalistOptions">
            <option value="San Francisco"></option>
            <option value="New York"></option>
            <option value="Seattle"></option>
            <option value="Los Angeles"></option>
            <option value="Chicago"></option>
          </datalist>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlSelect2" class="form-label">Example multiple select</label>
          <select multiple class="form-select" id="exampleFormControlSelect2" aria-label="Multiple select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
        <div>
          <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="pt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection
