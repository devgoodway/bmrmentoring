// Call the dataTables jQuery plugin
$.extend( true, $.fn.dataTable.defaults, {
    "info" : false
} );


$('#dataTable').DataTable({
    // responsive: true,
    // scrollY:        '50vh',
    // scrollCollapse: false,
    // searching: false,
    // ordering:  false,
    paging:         false,
    "language": {
        "lengthMenu": "_MENU_ 페이지마다 보이기",
        "zeroRecords": "찾는 정보가 없습니다.",
        "info": "현재 페이지 _PAGE_ / _PAGES_",
        "infoEmpty": "더 이상 찾을 수 없습니다.",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "",
        "searchPlaceholder": "검색하세요"
    }
});

$('#no').DataTable({
    // responsive: true,
    // scrollY:        '50vh',
    // scrollCollapse: false,
    // searching: false,
    ordering:  false,
    paging:         false,
    "language": {
        "lengthMenu": "_MENU_ 페이지마다 보이기",
        "zeroRecords": "찾는 정보가 없습니다.",
        "info": "현재 페이지 _PAGE_ / _PAGES_",
        "infoEmpty": "더 이상 찾을 수 없습니다.",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "",
        "searchPlaceholder": "검색하세요"
    }
});