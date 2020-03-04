$(document).ready(function() {
    $.typeahead({
        input: ".js-typeahead",
        order: "asc",
        dynamic: true,
        debug: true,
        filter: false,
        display: ["name", "banners"],
        group: "type",
        source: {
            groupName: {
                ajax: {
                    url: '/search',
                    data: {
                        term: '{{query}}'
                    },
                    // path: 'banner'
                }
            }
        },
        callback: {
            onInit: function () {
                console.log('typeahead init');
            },
            onClickBefore: function (node, a, item, event) {
                event.preventDefault();
                window.location = item.search_result_url;
            },
        }
    });
});

