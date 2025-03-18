@extends('layout.app')

@section('content')
    <!-- Container for content -->
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-10">
                <h3>Department List</h3>
            </div>
            <!-- Add New Button -->
            <div class="col-md-2">
                <button class="btn btn-success" onclick="deprtObj.addNewDepartment();">Add New Department</button>
            </div>
        </div>
        <!-- Filter Section -->
        <form action="javascript:;" method="GET" onsubmit="deprtObj.getDepartmentList(this);" id="filterForm">
        <div class="row mb-3">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="name" placeholder="Department Name">
                </div>
                <input type="hidden" name="sort_type" id="sortType" value="{{request('sortType')}}">
                <input type="hidden" name="sort_column" id="sortColumn" value="{{request('sortColumn')}}">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" name="subimt" value="Search">Search</button>
                    <a href="javascript:;" class="btn reset-button" onclick="deprtObj.resetFilters();">Reset</a>
                </div>
            </div>
        </form>

        <!-- Search and Reset Buttons -->
        {{-- <div class="mb-3">

        </div> --}}
        <div class="row mb-3" id="departmentList">
        </div>
        <!-- Table Section -->

    </div>
@endsection

@section('jsSection')
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Dpartment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:;" data-id="" method="POST" id="departmentForm"
                        onsubmit="return deprtObj.submitForm(this);">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" name="name" class="form-control" id="departmentName"
                                placeholder="Enter Department name">
                            <span class="text-danger name-error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/department.js') }}"></script>
@endsection
