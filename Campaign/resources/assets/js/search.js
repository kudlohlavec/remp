$(document).ready(function() {
    $.typeahead({
        input: ".js-typeahead",
        dynamic: true,
        debug: true,
        filter: false,
        group: "type",
        source: {
            ajax: {
                url: '/search',
                data: {
                    term: '{{query}}'
                },
            }
        },
        //uncomment if custom type-related template will be needed
        /*template: function (query, item) {
            if (item.type === 'campaign') {
                return '{{name}}, related banners:{{banners}}'
            }

            return '{{name}}';
        },*/
        callback: {
            onPopulateSource: function (node, data, group, path) {
                let displayKeys = new Set();

                data.forEach( searchResult => {
                    //get relevant search keys from current searchResult
                    const searchKeys = Object.keys(searchResult).filter(isSearchRelevantKey);
                    //add search keys to displayKeys set (add method adds only unique items into the set)
                    searchKeys.forEach(searchKey => displayKeys.add(searchKey));
                });

                this.options.display = Array.from(displayKeys);
                return data;
            },
            onClickBefore: function (node, a, item, event) {
                event.preventDefault();
                window.location = item.search_result_url;
            },
        }
    });
});

function isSearchRelevantKey(key) {
    const irelevantKeys = ['type', 'search_result_url', 'group'];

    return !irelevantKeys.includes(key);
}

