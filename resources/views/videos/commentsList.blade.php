@foreach ($video->comments as $comment)
<input type="hidden" value="" name="commentId" class="commentId">
<div class="d-flex" id="commenthtml{{ $comment->id }}">
    @if ($comment->user->profile_image == null)
        <div class="avatar avatar-xs" data-bs-toggle="tooltip"
            data-bs-placement="top"
            aria-label="{{ $comment->user->name }}"
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
    <p class="mx-2" id="comment{{ $comment->id }}">
        {{ $comment->name }}<sup
            class="mx-2">({{ $comment->created_at->diffForHumans() }})</sup>
    </p>
    @if ($comment->user_id == auth()->id())
        <div class="editbtn" data-id="{{ $comment->id }}"><i
                class="bx bxs-edit"></i></div>
    @endif
    @if ($video->created_by == auth()->id())
        <div class="deletebtn" data-id="{{ $comment->id }}"><i
                class="bx bxs-trash"></i></div>
    @endif
</div>
@endforeach
