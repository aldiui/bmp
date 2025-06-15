$(document).ready(function () {
    $("#login").submit(function(e) {
        setButtonLoadingState("#login .btn.btn-sky-900", true, "Login");
        e.preventDefault();
        const url = "/login";
        const data = new FormData(this);

        const successCallback = function(response) {
            setButtonLoadingState("#login .btn.btn-sky-900", false,
                "Login");
            handleSuccess(response, null, null, null);
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#login .btn.btn-sky-900", false,
                "Login");
            handleValidationErrors(error, "login", ["email", "password"]);
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });
});