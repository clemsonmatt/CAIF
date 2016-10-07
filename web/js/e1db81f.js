$(function(){
    // Instantiate the Bloodhound suggestion engine
    var remoteNames = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/manage/search-person/%QUERY'
        }
    });

    // Initialize the Bloodhound suggestion engine
    remoteNames.initialize();

    // Instantiate the Typeahead UI
    $('.typeahead').typeahead(
        {
            hint: false,
            highlight: true,
            minLength: 1
        },
        {
            name: 'remoteNames',
            displayKey: 'name',
            valueKey: 'id',
            source: remoteNames.ttAdapter()
        }
    );

    /* add link to each person's profile */
    $("#type-ahead-input").on("typeahead:selected typeahead:autocompleted", function(e, datum) {
        var route = "/profile/"+datum.id;
        window.location = route;
    })
})
