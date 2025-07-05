const renderNews = (data) => {
    if (!Array.isArray(data)) return;
    $('#newsList').empty();

    data.forEach((item) => {
        const img =
            item.thumbnail && item.thumbnail.trim() !== ''
                ? item.thumbnail
                : 'https://via.placeholder.com/60x60?text=No+Image';

        $('#newsList').append(`
            <div class="news-card" data-id="${item.article_id}">
                <img src="${img}" alt="${item.title}" class="news-thumb" />
                <div class="title">${item.title}</div>
            </div>
        `);
    });

    if (data.length > 0) {
        showNewsDetail(data[0]);
        highlightSelected(data[0].article_id);
    }

    $('#newsList .news-card').on('click', function () {
        const id = $(this).data('id');
        const selected = data.find((n) => n.article_id == id);
        if (selected) {
            showNewsDetail(selected);
            highlightSelected(id);
        }
    });
};

const highlightSelected = (id) => {
    $('#newsList .news-card').removeClass('active');
    $(`#newsList .news-card[data-id="${id}"]`).addClass('active');
};

const showNewsDetail = (item) => {
    $('#detailTitle').text(item.title);
    $('#detailDate').text(
        moment(item.published_date || item.created_date || new Date()).format('DD MMM YYYY')
    );

    if (item.thumbnail && item.thumbnail.trim() !== '') {
        $('#detailImage').attr('src', item.thumbnail).show();
    } else {
        $('#detailImage').hide();
    }

    $('#detailContent').html(item.article_content ? item.article_content.replace(/\n/g, '<br>') : '-');
};

const getData = () => {
    getDataList(
        'admin/news/published',
        (res) => {
            if (res.status && Array.isArray(res.data)) {
                renderNews(res.data);
            } else {
                console.warn('Data kosong atau tidak valid');
                $('#newsDetail').html('<p>Tidak ada berita tersedia.</p>');
                $('#newsList').empty();
            }
        },
        () => {
            console.log('Sedang memuat data...');
        }
    );
};

$(document).ready(() => {
    getData();
});