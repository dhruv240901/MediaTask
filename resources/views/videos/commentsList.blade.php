@foreach ($video->comments as $comment)
    <input type="hidden" value="" name="commentId" class="commentId">
    <div class="d-flex" id="commenthtml{{ $comment->id }}">
        @if ($comment->user->profile_image == null)
            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                aria-label="{{ $comment->user->name }}" data-bs-original-title="{{ $comment->user->name }}">
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
        @else
            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                aria-label="{{ $comment->user->name }}" data-bs-original-title="{{ $comment->user->name }}"><img
                    src="{{ asset($comment->user->profile_image) }}" alt="Avatar" class="rounded-circle  pull-up">
            </div>
        @endif
        <p class="mx-2" id="comment{{ $comment->id }}">
            {{ $comment->name }}<sup class="mx-2">({{ $comment->created_at->diffForHumans() }})</sup>
        </p>
        @if ($comment->user_id == auth()->id())
            <div class="editbtn" data-id="{{ $comment->id }}"><i class="bx bxs-edit"></i></div>
        @endif
        @if ($video->created_by == auth()->id())
            <div class="deletebtn" data-id="{{ $comment->id }}"><i class="bx bxs-trash"></i></div>
        @endif
    </div>
@endforeach
