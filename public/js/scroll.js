/**
 * メール部分をスクロールに合わせて追従する
 * @type {number}
 */
var oldScrollPoint = 0;
$(function () {
    $(window).scroll(function () {
        var ScrollPoint = $(window).scrollTop();
        setTimeout(function () {
            while (oldScrollPoint != ScrollPoint) {
                var scrollDifference = oldScrollPoint > ScrollPoint ? (-1) : 1;
                $('#mailText').css('padding-top', (oldScrollPoint += scrollDifference) + 'px');
            }
        }, 100);
    });
});