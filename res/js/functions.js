function searchRegion(regionId) {

    if(regionId == '') {

        return;
    }
    else {

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if ((this.readyState == 4) && (this.status == 200)) {

                let result = JSON.parse(this.responseText);

                if(result.length == 0) {

                    document.getElementById('region_id').value      = '';
                    document.getElementById('region_name').value    = '';
                    return;
                }

                document.getElementById('region_name').value = result[0].region_name;
            }
        }

        xhttp.open('GET', 'http://www.hrsystem.com/regions/search/'+regionId, true);
        xhttp.send();   
    }
}

function searchCountry(countryId) {

    if(countryId == '') {

        return;
    }
    else {

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if ((this.readyState == 4) && (this.status == 200)) {

                let result = JSON.parse(this.responseText);

                if(result.length == 0) {

                    document.getElementById('country_id').value      = '';
                    document.getElementById('country_name').value    = '';
                    return;
                }

                document.getElementById('country_name').value = result[0].country_name;
            }
        }

        xhttp.open('GET', 'http://www.hrsystem.com/countries/search/'+countryId, true);
        xhttp.send();   
    }
}