window.showMessage = true;
window.errorCallback = null;
var lastAttemptedUrl = null;
var applyFilter = null;
var currentUrl = new URL(window.location.href);

toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

$.ajaxSetup({
    error: function (xhr, res) {
        toastr.error(xhr.status + "Something went wrong");
    },
    timeout: 600000,
    headers: { "X-CSRF-Token": $('meta[name="csrf-token"]').attr("content") },
});

window.registerAjaxCall = function (url, method, data, success) {
    $.ajax({
        type: method,
        url: url,
        cache: false,
        data: data,
        dataType: "JSON",
        success: function (jsonData) {
            if (typeof success == "string") {
                window[success](jsonData);
            } else if (typeof success == "function") {
                success(jsonData);
            }
        },
        complete: function (XMLHttpRequest, textStatus) {
            window.showMessage = true;
        },
    });
};
