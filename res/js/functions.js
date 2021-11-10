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

function searchLocation(locationId) {

    if(locationId == '') {

        return;
    }
    else {

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if ((this.readyState == 4) && (this.status == 200)) {

                let result = JSON.parse(this.responseText);

                if(result.length == 0) {

                    document.getElementById('location_id').value      = '';
                    document.getElementById('location_name').value    = '';
                    return;
                }

                document.getElementById('location_name').value = result[0].street_address+' - '+result[0].city+'/'+result[0].state_province;
            }
        }

        xhttp.open('GET', 'http://www.hrsystem.com/locations/search/'+locationId, true);
        xhttp.send();   
    }
}

function search(argId, argModule) {

    let id      = argId;
    let module  = argModule;

    if((argId == '') || (argModule = '')) {

        return;
    }
    else {

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if ((this.readyState == 4) && (this.status == 200)) {

                let result = JSON.parse(this.responseText);

                if(result.length == 0) {

                    document.getElementById(module+'_id').value      = '';
                    document.getElementById(module+'_name').value    = '';
                    return;
                }

                switch(module) {

                    case 'region':
                        document.getElementById('region_name').value = result[0].region_name;
                    break;

                    case 'job':
                        document.getElementById('job_name').value = result[0].job_title;
                    break;

                    case 'department':
                        document.getElementById('department_name').value = result[0].department_name;
                    break;
                }
                
            }
        }

        xhttp.open('GET', 'http://www.hrsystem.com/'+module+'s/search/'+id, true);
        xhttp.send();   
    }
}