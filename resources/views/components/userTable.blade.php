<table class="datatables-users table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
    aria-describedby="DataTables_Table_0_info" style="width: 1387px;">
    <thead>
        <tr>
            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;"
                aria-label=""></th>
            <th class="sorting_disabled" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 400px;" aria-label="User: activate to sort column descending" aria-sort="ascending">User
            </th>
            <th class="sorting_disabled" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 224.5px;" aria-label="Role: activate to sort column ascending">
                Phone</th>
            <th class="sorting_disabled" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 224.5px;" aria-label="Plan: activate to sort column ascending">
                Gender</th>
            <th class="sorting_disabled" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                style="width: 115px;" aria-label="Status: activate to sort column ascending">
                Status</th>
            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 144px;" aria-label="Actions">
                Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $k => $user)
            <tr>
                <td class="  control" tabindex="0" style="display: none;"></td>
                <td class="sorting_1">
                    <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                                @if ($user->profile_image == null)
                                    <span class="avatar-initial rounded-circle bg-primary">
                                        @php
                                            $words = explode(' ', $user->name);
                                            $firstLetterFirstWord = strtoupper(substr(current($words), 0, 1));
                                            $firstLetterLastWord = strtoupper(substr(end($words), 0, 1));
                                            $result = $firstLetterFirstWord . $firstLetterLastWord;
                                        @endphp
                                        {{ $result }}
                                    </span>
                                @else
                                    <img src="{{ asset($user->profile_image) }}"
                                        class="avatar-initial rounded-circle bg-label-dark">
                                @endif
                            </div>

                        </div>
                        <div class="d-flex flex-column"><span class="fw-medium">{{ $user->name }}
                            </span><small class="text-muted">{{ $user->email }}</small>
                        </div>
                    </div>
                </td>
                <td><span class="text-truncate d-flex align-items-center">{{ $user->phone }}</>
                </td>
                <td><span class="fw-medium">{{ $user->gender }}</span></td>
                <td><label class="switch">
                        <input type="checkbox" class="switch-input user-status" data-id="{{ $user->id }}"
                            @if ($user->is_active == true) checked @endif>
                        <span class="switch-toggle-slider">
                            <span class="switch-on"></span>
                            <span class="switch-off"></span>
                        </span>
                    </label></td>
                <td>
                    <div class="d-inline-block text-nowrap">
                        <a href="{{ route('user-edit', $user->id) }}" type="button" class="btn btn-info"><i
                                class="bx bxs-edit"></i></a>
                        <form action="{{ route('user-delete', $user->id) }}" method="POST" class="deleteform"
                            data-id="{{ $user->id }}" id="deleteform{{ $user->id }}"
                            style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {!! $users->links() !!}
    <div>
