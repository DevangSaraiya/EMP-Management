<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <a href="javascript:;" onclick="userObj.sortList(this);" data-sort-column="first_name" data-sort-type="{{($params['sort_type'] == 'asc') ? 'desc' : 'asc'}}">First Name</a>
            </th>
            <th>
                <a href="javascript:;" onclick="userObj.sortList(this);" data-sort-column="last_name" data-sort-type="{{($params['sort_type'] == 'asc') ? 'desc' : 'asc'}}">Last Name</a>
            </th>
            <th>Department</th>
            <th>Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($userData as $user)
        <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->department->name}}</td>
            <td style="text-transform:capitalize;">{{$user->status}}</td>
            <td class="text-center">
                <a href="javascript:;" onclick="userObj.editUser({{$user->id}})">Edit</a>&nbsp;
                <a href="javascript:;" onclick="userObj.deleteUser({{$user->id}})">Delete</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="100" class="text-center">No Records Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
