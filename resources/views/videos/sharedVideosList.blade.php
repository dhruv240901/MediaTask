@foreach ($sharedVideos as $video)
<div class="col-md-6 col-lg-4 mb-3">
    <div class="card h-100">
        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showVideo{{ $video->id }}"><img
                class="card-img-top"
                src="{{ asset('user/' . $video->created_by . '/media/' . $video->id . '/thumbnail/' . $video->file_name . '.jpg') }}"
                alt="Card image cap" /></a>
        <div class="card-body">
            <h5 class="card-title">{{ $video->name }}</h5>
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
                <video width="700" height="240" controls>
                    <source src="{{ asset($video->file_url) }}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
@endforeach
