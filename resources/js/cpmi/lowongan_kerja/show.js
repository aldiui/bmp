$(document).ready(function () {
    $("#lamaran-kerja").submit(function(e) {
        setButtonLoadingState("#lamaran-kerja .btn.btn-sky-900", true, "Lamarkan Pekerjaan");
        e.preventDefault();
        const url = "/cpmi/lamaran-kerja";
        const data = new FormData(this);
        const slug = $("#slug").val();

        const successCallback = function(response) {
            setButtonLoadingState("#lamaran-kerja .btn.btn-sky-900", false,
                "Lamarkan Pekerjaan");
            handleSuccess(response, null, null, "/cpmi/lowongan-kerja/" + slug);
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#lamaran-kerja .btn.btn-sky-900", false,
                "Lamarkan Pekerjaan");
            handleValidationErrors(error, "lamaran-kerja", ["lowongan_kerja"]);
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });
});