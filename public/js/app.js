
/* Csrf protection init */

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* * */

/* cookie check */
    $( document ).ready(function() {
        
    var sessionId = $.cookie('sessionId'); //session cookie

        if (sessionId == null) {

            var cookieVal = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

            // create cookie 
            $.cookie('sessionId', cookieVal, 
            { 
                expires: 365, 
                path: '/' 
            });

        }

    });
/* * */

/* set data for first tab */
    $(document).ready(function() {

        var activeTabName = $('.nav-tabs .active').text().replace(/\s/g,'');
        
        if (activeTabName != '') {
            getTabData(activeTabName);
        }
        
    });
/* * */

/* send ajax request to add new tab */

$( "#addTab" ).on('submit', function(event) {

    event.preventDefault(); // prevent from submiting form

    // serialize form data
    var formData = $( "#addTab" ).serialize();

    // post data to api
    $.post( "/api/add-tab", formData)
    .done(function( data ) {
          
          // active tab name - to check if already exists
          var activeTabName = $('.nav-tabs .active').text().replace(/\s/g,'');
          var cityName = data.cityName; //city name from object

          // if one or more tabs exists already
          if (activeTabName != '') {

            /* append new tab */
            $('<a class="nav-item nav-link" onclick="getTabData(\''
            +cityName+'\')" id="nav-'
            +cityName+'-tab" data-toggle="tab" href="#nav-'
            +cityName+'" role="tab" aria-selected="false">'
            +cityName+
            '</a>')
            .appendTo("#nav-tab");

            /* append new tab content div */
            $('<div class="tab-pane fade" id="nav-'
            +cityName+'" role="tabpanel" aria-labelledby="nav-'
            +cityName+'-tab"><div id="tab-data-'
            +cityName+'"></div></div>')
            .appendTo("#nav-tabContent");

          }
          // if not tabs is still existing
          else {

            /* append new active tab */
            $('<a class="nav-item nav-link active" onclick="getTabData(\''
            +cityName+'\')" id="nav-'
            +cityName+'-tab" data-toggle="tab" href="#nav-'
            +cityName+'" role="tab" aria-selected="false">'
            +cityName+
            '</a>')
            .appendTo("#nav-tab");

            /* append new active tab content div */
            $('<div class="tab-pane active" id="nav-'
            +cityName+'" role="tabpanel" aria-labelledby="nav-'
            +cityName+'-tab"><div id="tab-data-'
            +cityName+'"></div></div>')
            .appendTo("#nav-tabContent");

            //get tab data
            getTabData(cityName);

          }

    })
    .fail(function(error) {
        console.log(error);
    });

});    

/* * */

/* get tab data by city */

function getTabData(city) {
    
    $.get("/api/get-tab-data/"+city)
    .done(function( data ) {
        
        // weather variables
        var cityName = data.data.name;
        var country = data.data.country;
        var weatherTemp = data.data.temp;
        var weatherDesc = data.data.description;

        // append weather data
        $("#tab-data-"+city).html(
            '<ul class="list-group list-group-flush"><li class="list-group-item"><strong>'
            +cityName+', '+country+'</strong></li><li class="list-group-item">'
            +weatherTemp+'°C</li><li class="list-group-item">'
            +weatherDesc+'</li></ul>'
        );
    })
    .fail(function() {

        // failed no data recieved
        $("#tab-data-"+city).html('<strong>No data</strong>');
    });
    
    

}