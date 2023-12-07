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
                {{-- <div class="btn-group">
                    <a type="button" class="btn btn-outline-info dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class='bx bxs-share-alt'></i></a>
                    <ul class="dropdown-menu" style="">
                        @foreach ($otherUsers as $user)
                            <li><a class="dropdown-item" href="javascript:void(0);">{{ $user->name }}</a></li>
                        @endforeach
                    </ul>
                </div> --}}


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

    <div class="modal fade" id="shareVideo{{ $video->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Share To</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('share-video') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $video->id }}" name="videoId">
                        {{-- @foreach ($otherUsers as $user)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="defaultCheck3"
                                    name="sharedUserList[]" value="{{ $user->id }}">
                                <label class="form-check-label" for="defaultCheck3">
                                    {{ $user->name }}
                                </label>
                            </div>
                        @endforeach --}}
                        <div class="col-md-12 mb-4">
                          <label for="TagifyUserList" class="form-label">Users List</label>
                          <input id="TagifyUserList" name="TagifyUserList" class="form-control" value="abatisse2@nih.gov, Justinian Hattersley" />
                        </div>
                        <button type="submit" class="btn btn-primary">Share</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
{!! $videos->links() !!}
