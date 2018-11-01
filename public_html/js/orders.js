$('.status').on('click', function () {
    let id = $(this).data('id');
    $.post(
        '/admin/admin.php?action=Orderview&change',
        {id: id},
        (response) => {
            $(this).html(response);
        }
    );
});