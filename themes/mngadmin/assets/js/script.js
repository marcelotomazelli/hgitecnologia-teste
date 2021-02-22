$('[data-rmvuser]').on('click', e => {
    let current = $(e.currentTarget);
    let data = current.data();

    $.post(data.rmvuser, data, response => {
        if (response.message) {
            $('.ajax_page_message').html(response.message);
            $('html, body').animate({scrollTop: '0px'}, 200);
        }

        if (response.success) {
            let parent = current.parent();

            if (parent[0].nextElementSibling != null) {
                parent[0].nextElementSibling.remove();
            } else if (parent[0].previousElementSibling != null) {
                $(parent[0].previousElementSibling).remove();
            }

            parent.remove();
        }
    }, 'json');
})
