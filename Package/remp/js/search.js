require('jquery-typeahead');

$(document).ready(function() {
    $.typeahead({
        input: ".js-typeahead",
        dynamic: true,
        filter: false,
        highlight: false,
        maxItem: false,
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
                    searchKeys.forEach(searchKey => {
                        //add search keys to displayKeys set (add() method adds only unique items into the set)
                        displayKeys.add(searchKey);
                        //and add keys to the displayed results as well
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
            onSubmit: function (node, form, item, event) {
                event.preventDefault();
            }
        }
    });
});

function isSearchRelevantKey(key) {
    const irelevantKeys = ['type', 'search_result_url', 'group'];

    return !irelevantKeys.includes(key);
}

