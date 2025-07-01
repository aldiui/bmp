import 'leaflet/dist/leaflet.css';
import $ from 'jquery';
import Swal from 'sweetalert2';
import L from 'leaflet';

window.$ = window.jQuery = $;

const ajaxCall = (url, method = 'POST', data = {}, successCallback = () => {}, errorCallback = () => {}) => {
    $.ajax({
        type: method,
        url,
        data,
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        headers: {
            Accept: 'application/json',
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
        },
        success: response => successCallback(response),
        error: error => errorCallback(error),
    });
};

const handleValidationErrors = (error, formId = null, fields = []) => {
    const responseData = error?.responseJSON?.data;

    if (responseData && formId && fields.length > 0) {
        fields.forEach(field => {
            const inputSelector = `#${formId} #${field}`;
            const errorSelector = `#${formId} #error${field}`;
            if (responseData[field]) {
                $(inputSelector).addClass('is-invalid');
                $(errorSelector).html(responseData[field][0]);
            } else {
                $(inputSelector).removeClass('is-invalid');
                $(errorSelector).html('');
            }
        });
    } else {
        showErrorAlert(error?.responseJSON?.message || error.statusText);
    }
};

const showErrorAlert = (message = 'Terjadi kesalahan.') => {
    Swal.fire({
        title: 'Gagal',
        icon: 'error',
        text: message,
        timer: 2000,
        showConfirmButton: false,
    });
};

const handleSuccess = (message, dataTableId = null, modalId = null, redirect = null) => {
    const showSuccessAlert = () => {
        return Swal.fire({
            title: 'Berhasil',
            icon: 'success',
            text: message.message,
            timer: 2000,
            showConfirmButton: false,
        });
    };

    if (dataTableId) {
        showSuccessAlert();
        $(`#${dataTableId}`).DataTable().ajax.reload();
    }

    if (modalId) {
        $(`#${modalId}`).modal('hide');
    }

    if (redirect && redirect !== 'no') {
        showSuccessAlert().then(() => {
            window.location.href = redirect;
        });
    } else if (redirect === 'no' && !dataTableId) {
        showSuccessAlert();
    } else {
        showSuccessAlert();
    }
};

const setButtonLoadingState = (buttonSelector, isLoading = true, title = 'Simpan') => {
    const buttonContent = isLoading
        ? `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> ${title}`
        : title;

    $(buttonSelector).prop('disabled', isLoading).html(buttonContent);
};

window.ajaxCall = ajaxCall;
window.handleValidationErrors = handleValidationErrors;
window.showErrorAlert = showErrorAlert;
window.handleSuccess = handleSuccess;
window.setButtonLoadingState = setButtonLoadingState;

$(document).ready(function () {
    const $navFitur = $('#customNav');
    const $navbarToggler = $('.navbar-toggler');

    if ($navFitur.length && $navbarToggler.length) {
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > 50) {
                $navFitur.addClass('bg-white shadow-sm');
            } else {
                $navFitur.removeClass('bg-white shadow-sm');
            }
        });

        $navbarToggler.on('click', function () {
            if ($(window).scrollTop() < 50) {
                $navFitur.toggleClass('bg-white shadow-sm');
            }
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.navbar-collapse').length) {
                $('.navbar-collapse').removeClass('show');
            }
        });
    }
});
