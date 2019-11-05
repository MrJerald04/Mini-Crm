var map;
var myLatLng;
$(document).ready(function() {
    mainMap();

    //Main Map latlang that point to philippines
    function mainMap() {
        var latval = 12.793043478261;
        var lngval = 121.68079910011;

        myLatLng = new google.maps.LatLng(latval, lngval);
        createMap(myLatLng);
        showCompanies();
        showEmployees();
    }

    //create map
    function createMap(myLatLng) {
        map = new google.maps.Map(document.getElementById("map"), {
            center: myLatLng,
            zoom: 4
        });
    }

    //Create Marker for Companies
    function createMarkerForCompany(latlng, name, color) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: {
                // path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                path: google.maps.SymbolPath.CIRCLE,
                strokeColor: color,
                strokeWeight: 12,
                scale: 3
            },
            title: name
        });
    }
    //Create Marker for Employees
    function createMarkerForEmployee(latlng, name, color) {
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: {
                path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                strokeColor: color,
                strokeWeight: 4,
                scale: 2
            },
            title: name
        });
    }

    function showCompanies() {
        $.get("/api/showCompanies", function(data, status) {
            console.log(data);
            $.each(data, function(i, val) {
                var clatval = val.lat;
                var clngval = val.lng;
                var cname = val.name;
                var color = val.color;
                var companiesLatLng = new google.maps.LatLng(clatval, clngval);
                createMarkerForCompany(companiesLatLng, cname, color);
            });
        });
    }
    function showEmployees() {
        $.get("/api/showEmployees", function(data, status) {
            // console.log(data);
            $.each(data, function(i, val) {
                var elatval = val.lat;
                var elngval = val.lng;
                var efname = val.first_name + " ( " + val.name + " ) ";
                var color = val.color;
                var employeesLatLng = new google.maps.LatLng(elatval, elngval);
                createMarkerForEmployee(employeesLatLng, efname, color);
            });
        });
    }
});
