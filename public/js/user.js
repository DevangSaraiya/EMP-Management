var UserClass = function () {
    let $this = this;
    this.init = () => {
        this.eventListner();
        this.getUserList();
    };

    this.addNewUser = () => {
        $('.text-danger').text("");
        $("#userForm").attr("data-id", "");
        $('#addUserModal').find(".modal-title").text("Add New User");
        $("#userForm")[0].reset();
        $('#addUserModal').modal('show');
    };

    this.editUser = (userId) => {
        $('.text-danger').text("");
        $("#userForm").attr("data-id", userId);
        $('#addUserModal').find(".modal-title").text("Edit User");
        $("#userForm")[0].reset();

        registerAjaxCall("/user/" + userId + "/edit", "GET", {}, function (response) {
            if (response.type == "success") {
                $("#firstName").val(response.user.first_name);
                $("#lastName").val(response.user.last_name);
                $("#department").val(response.user.department_id);
                $("input[value='"+response.user.status+"']").prop("checked", true);
            } else {
                toastr.error("User not found");
            }
        });
        $('#addUserModal').modal('show');
    };

    this.submitForm = (formObj) => {
        var ajaxUrl = "";
        var formData = $(formObj).serializeArray();
        var method = "POST";
        if ($("#userForm").attr("data-id") == "") {
            ajaxUrl = "/user";
        } else {
            ajaxUrl = "/user/" + $("#userForm").attr("data-id");
            method = "PUT";
        }
        registerAjaxCall(ajaxUrl, method, formData, function(response) {
            if (response.type == "success") {
                toastr.success(response.message);
                $("#userForm")[0].reset();
                $this.getUserList($("#filterForm"));
                $('#addUserModal').modal('hide');
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

    this.deleteUser = (userId) => {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            registerAjaxCall('/user/' + userId, "POST", {"_method": "delete"}, function(response) {
                if (response.type == "success") {
                    toastr.success(response.message);
                    $this.getUserList($("#filterForm"));
                } else {
                    toastr.error(response.message);
                }
            });
            // Perform the action if confirmed
        }
    };

    this.getUserList = (formObj) => {
        var filterData = $(formObj).serializeArray();
        registerAjaxCall("/user", "GET", filterData, function(response) {
            if (response.type == "success") {
                $("#userList").html(response.view);
            }
        });
    };

    this.sortList = (element) => {
        $("#sortType").val($(element).attr("data-sort-type"));
        $("#sortColumn").val($(element).attr("data-sort-column"));
        this.getUserList($("#filterForm"));
    };

    this.resetFilters = () => {
        $("#filterForm")[0].reset();
        this.getUserList($("#filterForm"));
    }


    this.eventListner = () => {
        // alert(number);
    };
    this.init();
}

var userObj = new UserClass();
