@foreach ($videos as $video)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card h-100">
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#showVideo{{ $video->id }}"><img
                    class="card-img-top"
                    src="{{ asset('user/' . auth()->id() . '/media/' . $video->id . '/thumbnail/' . $video->file_name . '.jpg') }}"
                    alt="Card image cap" /></a>
            <div class="card-body">
                <h5 class="card-title">{{ $video->name }}</h5>
                <a href="{{ route('edit-video', $video->id) }}" class="btn btn-outline-primary"><i
                        class="bx bxs-edit"></i></a>
                <form action="{{ route('delete-video', $video->id) }}" method="POST" class="softdeleteform"
                    style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"><i class="bx bxs-trash"></i></button>
                </form>
                <a href="javascript:void(0)" class="btn btn-outline-info" data-bs-toggle="modal"
                    data-bs-target="#shareVideo{{ $video->id }}"><i class='bx bxs-share-alt'></i></a>
                <a href="javascript:void(0)" class="btn btn-secondary float-end comment-btn" data-bs-toggle="modal"
                    data-bs-target="#comment{{ $video->id }}"><i class='bx bxs-message-rounded-dots'></i></a>
                <div class="avatar-group d-flex align-items-center assigned-avatar mt-2">
                    @foreach ($video->users as $user)
                        @if ($user->profile_image)
                            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                aria-label="{{ $user->name }}" data-bs-original-title="{{ $user->name }}"><img
                                    src="{{ asset($user->profile_image) }}" alt="Avatar"
                                    class="rounded-circle  pull-up"></div>
                        @else
                            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                aria-label="{{ $user->name }}" data-bs-original-title="{{ $user->name }}">
                                <span class="avatar-initial rounded-circle bg-primary">
                                    @php
                                        $words = explode(' ', $user->name);
                                        $firstLetterFirstWord = strtoupper(substr(current($words), 0, 1));
                                        $firstLetterLastWord = strtoupper(substr(end($words), 0, 1));
                                        $result = $firstLetterFirstWord . $firstLetterLastWord;
                                    @endphp
                                    {{ $result }}
                                </span>
                            </div>
                        @endif
                    @endforeach
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
                    <video id="Video" width="700" height="240" controls>
                        <source src="{{ asset($video->file_url) }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shareVideo{{ $video->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Share To</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('share-video') }}" method="POST" class="shareuserform"
                        data-id="{{ $video->id }}" id="shareuserform{{ $video->id }}">
                        @csrf
                        <input type="hidden" value="{{ $video->id }}" name="videoId">
                        <div class="col-md-12 mb-4">
                            <div class="position-relative">
                                <select id="selectpickerLiveSearch selectpickerSelectDeselect" name="sharedUserList[]"
                                    class="selectpicker w-100" data-style="btn-default" data-live-search="true" multiple
                                    data-actions-box="false" data-size="5" placeholder="Select User">
                                    @foreach ($otherUsers as $user)
                                        @if ($user->profile_image == '')
                                            @php
                                                $words = explode(' ', $user->name);
                                                $firstLetterFirstWord = strtoupper(substr(current($words), 0, 1));
                                                $firstLetterLastWord = strtoupper(substr(end($words), 0, 1));
                                                $result = $firstLetterFirstWord . $firstLetterLastWord;
                                            @endphp
                                            <option
                                                {{ in_array($video->id, $user->videos->pluck('id')->toArray()) ? 'selected' : '' }}
                                                value="{{ $user->id }}"
                                                data-content="<span class='avatar-initial text-white p-1 rounded-circle bg-primary'>{{ $result }}</span>&nbsp;{{ $user->name }}">
                                                {{ $user->name }}</option>
                                        @else
                                            <option
                                                {{ in_array($video->id, $user->videos->pluck('id')->toArray()) ? 'selected' : '' }}
                                                value="{{ $user->id }}"
                                                data-content="<img src='{{ asset($user->profile_image) }}' class='rounded-circle' width='30' height='30'>&nbsp;{{ $user->name }}">
                                                {{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary sharebtn">Share</button>
                    </form>
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
                        <input type="hidden" value="{{ $video->id }}" name="videoId" class="videoId">
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
                                        @include('videos.commentsList')
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
{!! $videos->links() !!}
