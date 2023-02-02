/**
 * Newsクラス
 */
class News {
    constructor(id, title, text, url, imageUrl, createDt) {
        this.id = id;
        this.title = title;
        this.text = text;
        this.url = url;
        this.imageUrl = imageUrl;
        this.createDt = createDt;
    }

    /**
     * class card-contentから要素を取り出す
     * @param cardContent  <div class="card-content">のDOM
     */
    domParse(cardContent) {
        // this.id = cardContent.find('.btn-floating').attr('id');
        this.title = cardContent.find('.card-title').text();
        this.text = cardContent.find('.card-text').text();
        this.url = cardContent.find('.card-url').text();
        this.createDt = cardContent.find('.card-date').text();
    }
}

/**
 * +ボタンが押されたらニュースをメール側に移動させる。
 */
$(document).on("click", ".btn-floating", function () {
        // 追加ボタンを押されたニュースを解析してオブジェクトに保管

        const news = new News();
        news.domParse($(this).parent());
        console.log(news);

        // twigとバインド文字が被っているので <% %> でバインドできるようにする
        $.views.settings.delimiters("<%", "%>");
        const template = $("#templateHirayma");
        const newsHtml = template.render(news);
        $('#mailText').append(newsHtml);
    }
);