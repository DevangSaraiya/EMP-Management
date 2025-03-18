<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <a href="javascript:;" onclick="deprtObj.sortList(this);" data-sort-column="name" data-sort-type="{{($params['sort_type'] == 'asc') ? 'desc' : 'asc'}}">First Name</a>
            </th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($departmentData as $department)
        <tr>
            <td>{{$department->name}}</td>
            <td class="text-center">
                <a href="javascript:;" onclick="deprtObj.editDepartment({{$department->id}})">Edit</a>&nbsp;
                <a href="javascript:;" onclick="deprtObj.deleteDepartment({{$department->id}})">Delete</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="100" class="text-center">No Records Found</td>
        </tr>
        @endforelse
    </tbody>
</table>
