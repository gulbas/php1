$('.order_status').on('click', function () {
    let id = $(this).data('id');
    let parent = $(this).closest("tr");
    // console.log(parent);
    $.post(
        '/shop/order.php?action=del',
        {id: id},
        () => {
            $(parent).detach();
        }
    );
});