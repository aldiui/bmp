$(document).ready(function () {
    getLowonganKerja(1);

    $('#search, #kategori').on('input change', function() {
        getLowonganKerja(1);
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        getLowonganKerja(page);
    });

});

const getLowonganKerja = (page) => {
    let search = $("#search").val();
    let kategori = $("#kategori").val();
    let negara =  $("#negara").val();
    $.ajax({
        url: "/cpmi/lowongan-kerja?page=" + page,
        data: {
            search,
            kategori,
            negara
        },
        success: function(data) {
            $("#lowongan-kerja").html(data);
        }
    });
};