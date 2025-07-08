$(document).ready(function () {
    $("#registrasi").submit(function(e) {
        setButtonLoadingState("#registrasi .btn.btn-sky-900", true, "Registrasi");
        e.preventDefault();
        const url = "/registrasi";
        const data = new FormData(this);

        const successCallback = function(response) {
            setButtonLoadingState("#registrasi .btn.btn-sky-900", false,
                "Registrasi");
            handleSuccess(response, null, null, "/");
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#registrasi .btn.btn-sky-900", false,
                "Registrasi");
            handleValidationErrors(error, "registrasi", ["nama", "email", "telepon", "alamat", "lokasi", "password", "konfirmasi_password"]);
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });
});