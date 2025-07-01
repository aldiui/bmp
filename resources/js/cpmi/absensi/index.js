$(document).ready(function () {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
    } else {
        handleSimpleError("Geolocation is not supported by this browser.");
    }

    
    setInterval(updateClock, 1000);
    updateClock();
    
    $("#absensiButton").click(function(e) {
        setButtonLoadingState("#absensiButton", true, 'Absensi');
        e.preventDefault();

        const url = "/cpmi/absensi";
        const data = new FormData();
        const locationValue = $("#lokasi").val();
        data.append("lokasi", locationValue);
        data.append("alasan", $("#alasan").val());

        const successCallback = function(response) {
            setButtonLoadingState("#absensiButton", false, 'Absensi');
            handleSuccess(response, null, null, "/cpmi/absensi");
        };

        const errorCallback = function(error) {
            setButtonLoadingState("#absensiButton", false, 'Absensi');
            handleValidationErrors(error);
            if (error?.responseJSON?.data == 'telat') {
                setTimeout(function() {
                    getModal('alasanModal');
                }, 200);
            }
        };

        ajaxCall(url, "POST", data, successCallback, errorCallback);
    });

    $("#saveAlasan").click(function() {
        const alasanValue = $("#alasan").val();
        setButtonLoadingState("#saveAlasan", false);
        if (alasanValue.trim() === "") {
            $("#alasan").addClass("is-invalid");
            $("#erroralasan").text("Alasan harus diisi");
        } else {
            $("#absensiButton").click();
            $("#alasanModal").modal("hide");
        }
    });

});

const getModal = (targetId) => {
    $(`#${targetId}`).modal("show");
    $(`#${targetId} .form-control`).removeClass("is-invalid");
    $(`#${targetId} .invalid-feedback`).html("");
    $(`#${targetId} small .text-danger`).html("");
    $(`#${targetId} .form-control`).val("");
};

const updateClock = () =>{
    const now = new Date();
    const jam = now.toLocaleTimeString('id-ID');
    $('#jam').text(jam);
}

let map;
let circle;
let distanceLine;

const showPosition = (position) => {
    const location = $("#lokasi");
    location.val(position.coords.latitude + ", " + position.coords.longitude);

    const userLatLng = [position.coords.latitude, position.coords.longitude];

    if (!map) {
        map = L.map('map').setView(userLatLng, 20);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    } else {
        map.setView(userLatLng);
    }

    const pengaturan = {
        latitude: parseFloat($("#latitude").val()) || -6.9,
        longitude: parseFloat($("#longitude").val()) || 107.6,
        nama: $("#nama_lokasi").val() || "Lokasi Tidak Dikenal",
        radius: parseInt($("#radius").val()) || 100
    };

    const pengaturanLatLng = [pengaturan.latitude, pengaturan.longitude];

    if (!circle) {
        L.marker(pengaturanLatLng).addTo(map).bindPopup(pengaturan.nama).openPopup();
        circle = L.circle(pengaturanLatLng, {
            color: 'green',
            fillColor: 'green',
            fillOpacity: 0.3,
            radius: pengaturan.radius
        }).addTo(map);
    }

    if (distanceLine) {
        map.removeLayer(distanceLine);
    }

    const lineCoordinates = [userLatLng, pengaturanLatLng];
    distanceLine = L.polyline(lineCoordinates, {
        color: 'red'
    }).addTo(map);

    L.marker(userLatLng).addTo(map).bindPopup('Anda di sini').openPopup();
};