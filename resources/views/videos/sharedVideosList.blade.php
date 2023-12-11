@foreach ($sharedVideos as $video)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showVideo{{ $video->id }}"><img
                    class="card-img-top"
                    src="{{ asset('user/' . $video->created_by . '/media/' . $video->id . '/thumbnail/' . $video->file_name . '.jpg') }}"
                    alt="Card image cap" /></a>
            <div class="card-body">
                <div>
                    <h5 class="card-title">{{ $video->name }}</h5>
                    <a href="javascript:void(0)" class="btn btn-secondary float-end" data-bs-toggle="modal"
                    data-bs-target="#comment{{ $video->id }}"><i class='bx bxs-message-rounded-dots'></i></a>
                </div>
                <p>Shared By: </p>
                <div class="avatar-group d-flex align-items-center assigned-avatar mt-2">

                    @if ($video->user->profile_image != null)
                        <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                            aria-label="{{ $video->user->name }}" data-bs-original-title="{{ $video->user->name }}"><img
                                src="{{ asset($video->user->profile_image) }}" alt="Avatar"
                                class="rounded-circle  pull-up"></div>
                    @else
                        <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                            aria-label="{{ $video->user->name }}" data-bs-original-title="{{ $video->user->name }}"><img
                                src='https://ui-avatars.com/api/?name={{ urlencode($video->user->name) }}&size=30&background=696cff&color=FFFFFF'
                                alt="Avatar" class="rounded-circle  pull-up"></div>
                    @endif
                </div>
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

    <div class="modal fade" id="comment{{ $video->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">{{ $video->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-4">
                        <form action="{{ route('store-comments') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $video->id }}" name="videoId">
                            <label for="defaultFormControlInput" class="form-label">Enter comment</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" name="comment">
                            <button type="submit" class="btn btn-primary sharebtn mt-2">Add Comment</button>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md">
                            <div class="card card-action mb-4">
                                <div class="card-header collapsed">
                                    <div class="card-action-title">Show Comments</div>
                                    <div class="card-action-element">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" class="card-collapsible"><i
                                                        class="tf-icons bx bx-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse">
                                    <div class="card-body pt-0">
                                        @foreach ($video->comments as $comment)
                                            <div class="d-flex">
                                                @if ($comment->user->profile_image == null)
                                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" aria-label="{{ $comment->user->name }}"
                                                        data-bs-original-title="{{ $comment->user->name }}"><img
                                                            src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&size=30&background=696cff&color=FFFFFF"
                                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                                @else
                                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        aria-label="{{ $comment->user->name }}"
                                                        data-bs-original-title="{{ $comment->user->name }}"><img
                                                            src="{{ asset($comment->user->profile_image) }}"
                                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                                @endif
                                                <p class="mx-2">{{ $comment->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
{!! $sharedVideos->links() !!}
