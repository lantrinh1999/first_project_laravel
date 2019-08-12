$(document).ajaxStart(function() { Pace.restart(); });
$(function() {
    $("#dataTable").dataTable({
        "ordering": true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ bản ghi trên trang",
            "zeroRecords": "Không có dữ liệu để hiển thị",
            "info": "Trang hiển thị _PAGE_ / _PAGES_",
            // "infoEmpty": "No records available",
            "infoEmpty": "Không có dữ liệu để hiển thị",
            // "infoFiltered": "(filtered from _MAX_ total records)",
            "infoFiltered": "(được lọc từ _MAX_ tổng số hồ sơ)",
            "search": 'Tìm kiếm:   ',
            "paginate": {
                "first": "Trang đầu",
                "last": "Trang cuối",
                "next": "Trang sau",
                "previous": "Trang trước"
            },
        }
    });
})

$(function() {
    $('body').on('click','.btn-remove', function() {
        // alert('ok');

        var removeUrl = $(this).attr('url');
        // alert(removeUrl);
        swal({
                title: "Cảnh báo",
                text: "Bạn có chắc chắn muốn xoá mục này không?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = removeUrl;
                }
            });
    });
})


$(function() {
    $('.select2').select2(); 
})