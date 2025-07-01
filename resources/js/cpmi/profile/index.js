$(document).ready(function () {
    $("#ubah-profile").submit(function(e) {
        setButtonLoadingState("#ubah-profile .btn.btn-sky-900", true, "Ubah Profile");
        e.preventDefault();
        const url = "/cpmi/profile";
        const data = new FormData(this);

        const successCallback = function(response) {
            setButtonLoadingState("#ubah-profile .btn.btn-sky-900", false,
                "Ubah Profile");
            handleSuccess(response, null, null, "/cpmi/profile");
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#ubah-profile .btn.btn-sky-900", false,
                "Ubah Profile");
            handleValidationErrors(error, "ubah-profile", ["email", "telepon", "alamat"]);
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });
    
    $("#ubah-password").submit(function(e) {
        setButtonLoadingState("#ubah-password .btn.btn-sky-900", true, "Ubah Password");
        e.preventDefault();
        const url = "/cpmi/ubah-password";
        const data = new FormData(this);

        const successCallback = function(response) {
            setButtonLoadingState("#ubah-password .btn.btn-sky-900", false,
                "Ubah Password");
            handleSuccess(response, null, null, "/cpmi/profile");
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#ubah-password .btn.btn-sky-900", false,
                "Ubah Password");
            handleValidationErrors(error, "ubah-password", ["password_lama", "password_baru", "konfirmasi_password_baru"]);
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });
});