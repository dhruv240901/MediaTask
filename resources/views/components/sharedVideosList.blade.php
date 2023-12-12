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
                            aria-label="{{ $video->user->name }}" data-bs-original-title="{{ $video->user->name }}">
                            <span class="avatar-initial rounded-circle bg-primary">
                              @php
                                  $words = explode(' ', $video->user->name);
                                  $firstLetterFirstWord = strtoupper(substr(current($words), 0, 1));
                                  $firstLetterLastWord = strtoupper(substr(end($words), 0, 1));
                                  $result = $firstLetterFirstWord . $firstLetterLastWord;
                              @endphp
                              {{ $result }}
                          </span>
                        </div>
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">{{ $video->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="Video" width="510" height="240" controls>
                        <source src="{{ asset($video->file_url) }}" type="video/mp4">
                    </video>
                    <div class="col-md-12 mb-4">

                        <input type="hidden" value="{{ $video->id }}" name="videoId">
                        <label for="defaultFormControlInput" class="form-label">Enter comment</label>
                        <input type="text" class="form-control form-text" id="form-text{{ $video->id }}"
                            aria-describedby="defaultFormControlHelp" name="comment">
                        <button type="button" class="btn btn-primary commentbtn mt-2"
                            data-id="{{ $video->id }}">Add Comment</button>

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
                                    <div class="card-body pt-0" id="comment-list{{ $video->id }}">
                                        @include('components.commentsList')
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
