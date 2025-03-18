var DepartmentClass = function () {
    let $this = this;
    this.init = () => {
        this.eventListner();
        this.getDepartmentList();
    };

    this.addNewDepartment = () => {
        $('.text-danger').text("");
        $("#departmentForm").attr("data-id", "");
        $('#addDepartmentModal').find(".modal-title").text("Add New Department");
        $("#departmentForm")[0].reset();
        $('#addDepartmentModal').modal('show');
    };

    this.editDepartment = (departmentId) => {
        $('.text-danger').text("");
        $("#departmentForm").attr("data-id", departmentId);
        $('#addDepartmentModal').find(".modal-title").text("Edit Department");
        $("#departmentForm")[0].reset();

        registerAjaxCall("/department/" + departmentId + "/edit", "GET", {}, function (response) {
            if (response.type == "success") {
                $("#departmentName").val(response.department.name);
            } else {
                toastr.error("Department not found");
            }
        });
        $('#addDepartmentModal').modal('show');
    };

    this.submitForm = (formObj) => {
        var ajaxUrl = "";
        var formData = $(formObj).serializeArray();
        var method = "POST";
        if ($("#departmentForm").attr("data-id") == "") {
            ajaxUrl = "/department";
        } else {
            ajaxUrl = "/department/" + $("#departmentForm").attr("data-id");
            method = "PUT";
        }
        registerAjaxCall(ajaxUrl, method, formData, function(response) {
            if (response.type == "success") {
                toastr.success(response.message);
                $("#departmentForm")[0].reset();
                $this.getDepartmentList($("#filterForm"));
                $('#addDepartmentModal').modal('hide');
            } else if (response.type = "validation_error"){
                $('.text-danger').text("");
                $.each(response.validation_errors, function (key, velidation_message) {
                    $(`.${key}-error`).text(velidation_message);
                });
            } else {
                toastr.error(response.message);
            }
        });
    };

    this.deleteDepartment = (departmentId) => {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            registerAjaxCall('/department/' + departmentId, "POST", {"_method": "delete"}, function(response) {
                if (response.type == "success") {
                    toastr.success(response.message);
                    $this.getDepartmentList($("#filterForm"));
                } else {
                    toastr.error(response.message);
                }
            });
        }
    };

    this.getDepartmentList = (formObj) => {
        var filterData = $(formObj).serializeArray();
        filterData.push({
            "type": $("#sortType").val()
        });

        filterData.push({
            "type": $("#sortColumn").val()
        });
        registerAjaxCall("/department", "GET", filterData, function(response) {
            if (response.type == "success") {
                $("#departmentList").html(response.view);
            }
        });
    };

    this.sortList = (element) => {
        $("#sortType").val($(element).attr("data-sort-type"));
        $("#sortColumn").val($(element).attr("data-sort-column"));
        this.getDepartmentList($("#filterForm"));
    };

    this.resetFilters = () => {
        $("#filterForm")[0].reset();
        this.getDepartmentList($("#filterForm"));
    }


    this.eventListner = () => {
        // alert(number);
    };
    this.init();
}

var deprtObj = new DepartmentClass();
