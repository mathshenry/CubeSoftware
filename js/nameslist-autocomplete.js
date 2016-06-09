$(function(){
    $('#autocomplete').autocomplete({
        lookup: names,
        onSelect: function (suggestion) {
        var thehtml = '<strong>Currency Name:</strong> ' + suggestion.name;
        $('#outputcontent').html(thehtml);
        }
    });
});
