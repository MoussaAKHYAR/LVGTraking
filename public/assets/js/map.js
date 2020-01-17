var map;
var geocoder;

function initMap(){
    // The location of Uluru
    var uluru = {lat:14.74187483, lng:-17.45565265};
    // The map, centered at Uluru
    map = new google.maps.Map(
        document.getElementById('map'), {zoom: 12, center: uluru});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });

    console.log('here')
    // var cdata = JSON.parse(document.getElementById('data').innerHTML);
    // geocoder = new google.maps.Geocoder();
    // codeAddress(cdata);
    // console.log(document.getElementById('allData'));
    var allData = JSON.parse(document.getElementById('allData').innerHTML);
    showAllColleges(allData);
    console.log(allData);
    // console.log(address);


    //console.log(JSON.parse(cdata));
}
//alert("hello");

function showAllColleges(allData) {
    Array.prototype.forEach.call(allData, function(data){
        // console.log()
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data.latitude, data.longitude),
            map: map
        });

    });
}

function codeAddress(cdata) {
    Array.prototype.forEach.call(cdata, function(data){
        var address = data.name + ' ' + data.address;
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                var points = {};
                points.id = data.id;
                points.lat = map.getCenter().lat();
                points.lng = map.getCenter().lng();
                updateCollegeWithLatLng(points);

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    });
}

function updateCollegeWithLatLng(points){
    $.ajax({
        url:"action.php",
        method:"post",
        data: points,
        success: function(res){
            console.log(res);
        }
    });

}