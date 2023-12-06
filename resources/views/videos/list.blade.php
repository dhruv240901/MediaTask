@extends('layouts/layoutMaster')

@section('title', 'Cards basic   - UI elements')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>
<div class="row mx-2 mb-3">
  <div class="col-md-2">
      <div class="me-3">
        <a href="{{ route('add-videos') }}" class="btn btn-primary">+Add Video</a>
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
{{-- <div class=" mb-3"> --}}
  {{-- <div class="col-md-2">
    <a href="{{ route('add-videos') }}" class="btn btn-primary">+Add Video</a>
  </div>
  <div class="col-md-2 float-end">
    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe" aria-describedby="defaultFormControlHelp">
  </div> --}}
  {{-- <div>
    <label for="defaultFormControlInput" class="form-label">Name</label>

  </div> --}}
  {{-- <a href="{{ route('add-videos') }}" class="btn btn-primary">+Add Video</a>
  <a href="{{ route('add-videos') }}" class="btn btn-primary float-end">+Add Video</a>
</div> --}}
<!-- Examples -->
<div class="row mb-5">
@foreach ($videos as $video)
 <div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
      <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showVideo{{ $video->id }}"><img class="card-img-top" src="{{asset('user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/'. $video->file_name.'.jpg')}}" alt="Card image cap" /></a>
      <div class="card-body">
        <h5 class="card-title">{{ $video->name }}</h5>
        <a href="{{ route('edit-video',$video->id) }}" class="btn btn-outline-primary">Edit</a>
        <form action="{{ route('delete-video', $video->id) }}" method="POST" class="softdeleteform"
          style="display: inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>
        <a href="javascript:void(0)" class="btn btn-outline-info">Share</a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="showVideo{{ $video->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">{{ $video->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex">
          <video width="400" height="240" controls>
            <source src="{{ asset($video->file_url) }}" type="video/mp4">
          </video>
        </div>
      </div>
    </div>
  </div>
@endforeach
{!! $videos->links() !!}
</div>


@endsection
