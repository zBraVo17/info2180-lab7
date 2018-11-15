/* global $*/

function getCountry(countr) {
    // jquery $.get
    $.get('world.php', countr, addResult);
}

function addResult(results) {
    document.getElementById('result').innerHTML = results;
}

document.addEventListener('DOMContentLoaded', function() {

    // jquery .before
    $('#lookup').before('<input type="checkbox" name="all" value="true" id="allResult"> All ');

    document.getElementById('lookup').addEventListener('click', function() {
        var country = document.getElementById('country').value;
        var all = document.getElementById('allResult').checked;
        var countr;

        if ( all )
            countr = {all: true};
        else
            countr = {country: country};

        getCountry(countr);
    });
});
        
    
