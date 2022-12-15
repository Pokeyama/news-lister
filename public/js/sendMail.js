/**
 * メールの送信
 */
$('#sendMail').click(function () {
        const mailBody = $('#mailBody').html();
        console.log(mailBody);
        // XSSの危険があるので消しとく
        $.ajax({
            url: '/php/sendMail.php', //アクセスするURL
            type: 'post', //post or get
            data: {
                text: mailBody
            },
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function (xhr) {
                console.log('error');
                console.log(xhr);
            })
            .always(function (xhr, msg) {
                //通信完了時の処理
                //結果に関わらず実行したいスクリプトを記載
                console.log(xhr);
                console.log(msg);
            });
    }
);