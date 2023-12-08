@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('vendor-script')
@include('components.toastr')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
@endsection



@section('content')
    <div class="row">
        <div class="col-md-10 stretch-card">
            <div id="welcome-animation">

            </div>
        </div>
    </div> <!-- row -->

@endsection
@section('page-script')
<script>
  const animationContainer = document.getElementById('welcome-animation');
  const animationPath = 'https://lottie.host/8c62dd60-a598-4031-b303-8a8060182b0a/gXCDH6FQYZ.json';

  const animation = lottie.loadAnimation({
      container: animationContainer,
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: animationPath
  });
</script>
@endsection
