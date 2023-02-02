$('#getYahooNews').click(function () {
    $.ajax({
        url: '/php/getYahooNews.php',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('.loader-wrap').css('display', 'flex');
        }

    })
        .done(function (res) {
            console.log(res);
            $('.loader-wrap').fadeOut();
            $(".card").remove();
            res.forEach(item => {
                    const news = new News();
                    news.title = item['NewsTitle'];
                    news.text = item['NewsText'];
                    news.url = item['NewsUrl'];
                    news.imageUrl = item['NewsImage'];
                    news.createDt = item['CreateDt'];
                    // console.log(news);
                    // twigとバインド文字が被っているので <% %> でバインドできるようにする
                    $.views.settings.delimiters("<%", "%>");
                    const template = $("#templateNewsCard");
                    const newsHtml = template.render(news);
                    $('#newsList').append(newsHtml);
                }
            );
        })
});

$('#getITMedia').click(function () {
    $.ajax({
        url: '/php/getITMedia.php',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('.loader-wrap').css('display', 'flex');
        }

    })
        .done(function (res) {
            console.log(res);
            $('.loader-wrap').fadeOut();
            $(".card").remove();
            res.forEach(item => {
                    const news = new News();
                    news.title = item['NewsTitle'];
                    news.text = item['NewsText'];
                    news.url = item['NewsUrl'];
                    news.imageUrl = item['NewsImage'];
                    news.createDt = item['CreateDt'];
                    // console.log(news);
                    // twigとバインド文字が被っているので <% %> でバインドできるようにする
                    $.views.settings.delimiters("<%", "%>");
                    const template = $("#templateNewsCard");
                    const newsHtml = template.render(news);
                    $('#newsList').append(newsHtml);
                }
            );
        })
});