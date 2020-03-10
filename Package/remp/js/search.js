require('jquery-typeahead');

$(document).ready(function() {
    $.typeahead({
        input: ".js-typeahead",
        dynamic: true,
        debug: true,
        filter: false,
        highlight: false,
        group: "type",
        source: {
            ajax: {
                url: '/search',
                data: {
                    term: '{{query}}'
                },
            }
        },
        callback: {
            onPopulateSource: function (node, data, group, path) {
                let displayKeys = new Set();

                data.forEach( searchResult => {
                    let keyOrder = 0;
                    //get relevant search keys from current searchResult
                    const searchKeys = Object.keys(searchResult).filter(isSearchRelevantKey);
                    //add search keys to displayKeys set (add() method adds only unique items into the set) and add keys to the displayed results as well
                    searchKeys.forEach(searchKey => {
                        displayKeys.add(searchKey);

                        searchResult[searchKey] = `<strong>${searchKey}:</strong> ${searchResult[searchKey]}`;
                        if (keyOrder > 0) {
                            searchResult[searchKey] = ', ' + searchResult[searchKey];
                        }
                        keyOrder++;
                    });
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

