@extends('layout.app')

@section('content')
    <!-- Container for content -->
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-10">
                <h3>User List</h3>
            </div>
            <!-- Add New Button -->
            <div class="col-md-2">
                <button class="btn btn-success" onclick="userObj.addNewUser();">Add New User</button>
            </div>
        </div>
        <!-- Filter Section -->
        <form action="javascript:;" method="GET" onsubmit="userObj.getUserList(this);" id="filterForm">
        <div class="row mb-3">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="last_name" placeholder="last Name">
                </div>
                <div class="col-md-2">
                    <select name="department_id" class="form-select" id="department_id">
                        <option value="">Select Department</option>
                        @forelse ($departmentList as $department)
                        <option value="{{ $department->id }}"> {{ $department->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active"> Active </option>
                        <option value="inactive"> Inactive </option>
                    </select>
                </div>
                <input type="hidden" name="sort_type" id="sortType" value="{{request('sortType')}}">
                <input type="hidden" name="sort_column" id="sortColumn" value="{{request('sortColumn')}}">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" name="subimt" value="Search">Search</button>
                    <a href="javascript:;" class="btn reset-button" onclick="userObj.resetFilters();">Reset</a>
                </div>
            </div>
        </form>

        <!-- Search and Reset Buttons -->
        {{-- <div class="mb-3">

        </div> --}}
        <div class="row mb-3" id="userList">
        </div>
        <!-- Table Section -->

    </div>
@endsection

@section('jsSection')
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:;" data-id="" method="POST" id="userForm"
                        onsubmit="return userObj.submitForm(this);">
                        @csrf
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName"
                                placeholder="Enter first name">
                            <span class="text-danger first_name-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName"
                                placeholder="Enter last name">
                            <span class="text-danger last_name-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <select class="form-select" name="department_id" id="department">
                                <option value="">Choose a department</option>
                                @forelse ($departmentList as $department)
                                    <option value="{{ $department->id }}"> {{ $department->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            <span class="text-danger department_id-error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status: </label><br>
                            <input type="radio" name="status" class="form-radio status" value="active"> Active
                            <input type="radio" name="status" class="form-radio status" value="inactive"> Inactive
                            <br>
                            <span class="text-danger status-error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
@endsection
