// タブ切り替え
$('.btn').click(function() {
    $('.card').removeClass('active');
    $(this).addClass('active');
    console.log(this);
});