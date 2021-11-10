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

                    if(module == 'countries') {

                        module = 'country';
                    }

                    document.getElementById(module+'_id').value      = '';
                    document.getElementById(module+'_name').value    = '';
                    return;
                }

                switch(module) {

                    case 'regions':
                        document.getElementById('region_name').value = result[0].region_name;
                    break;

                    case 'countries':
                        document.getElementById('country_name').value = result[0].country_name;
                    break

                    case 'locations':
                        document.getElementById('location_name').value = result[0].street_address+' - '+result[0].city+'/'+result[0].state_province;
                    break

                    case 'jobs':
                        document.getElementById('job_name').value = result[0].job_title;
                    break;

                    case 'departments':
                        document.getElementById('department_name').value = result[0].department_name;
                    break;
                }
                
            }
        }

        xhttp.open('GET', 'http://www.hrsystem.com/'+module+'/search/'+id, true);
        xhttp.send();   
    }
}