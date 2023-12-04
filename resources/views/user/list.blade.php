@foreach ($users as $k => $user)
<tr>
    <td class="  control" tabindex="0" style="display: none;"></td>
    <td class="sorting_1">
        <div class="d-flex justify-content-start align-items-center user-name">
            <div class="avatar-wrapper">
                <div class="avatar avatar-sm me-3"><img src="{{ $user->profile_image }}"
                        class="avatar-initial rounded-circle bg-label-dark"></div>
            </div>
            <div class="d-flex flex-column"><span class="fw-medium">{{ $user->name }}
                        </span><small class="text-muted">{{ $user->email }}</small>
            </div>
        </div>
    </td>
    <td><span class="text-truncate d-flex align-items-center">{{ $user->phone }}</></td>
    <td><span class="fw-medium">{{ $user->gender }}</span></td>
    <td><label class="switch">
      <input type="checkbox" class="switch-input" checked>
      <span class="switch-toggle-slider">
        <span class="switch-on"></span>
        <span class="switch-off"></span>
      </span>
    </label></td>
    <td>
        <div class="d-inline-block text-nowrap">
          <a href="{{ route('user-edit',$user->id) }}" type="button" class="btn btn-info"><i class="bx bxs-edit"></i></a>
          <form action="{{ route('user-delete', $user->id) }}" method="POST" class="softdeleteform" data-id="{{ $user->id }}" id="softdeleteform{{ $user->id }}"
            style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i></button>
          </form>
        </div>
    </td>
</tr>
@endforeach
{{ $users->links() }}
