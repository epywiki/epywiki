/*
let geoData = {};

fetch(BASE_URL + '/public/data/africa.json')
  .then(res => res.json())
  .then(data => {
    geoData = data;
    populateCountries();
  });

function populateCountries() {
    const countryInput = document.getElementById('country');
    const countryList = document.getElementById('countryList');
    countryList.innerHTML = '';

    Object.keys(geoData).forEach(country => {
        let option = document.createElement('option');
        option.value = country;
        countryList.appendChild(option);
    });

    countryInput.addEventListener('change', () => {
        const country = countryInput.value;
        if (!geoData[country]) return;

        // Show Level 1 input and label immediately
        showLevelInput('level1', 'level1Label', geoData[country].A1);

        // Clear lower levels
        clearLevelInput('level2', 'level2Label');
        clearLevelInput('level3', 'level3Label');

        // Populate Level 1 datalist if you have predefined options
        populateLevelDatalist('level1', geoData[country].A1Options || []);
    });

    // Chain event listeners for Level 1 and Level 2 to show next level immediately
    document.getElementById('level1').addEventListener('change', () => {
        const country = countryInput.value;
        if (!geoData[country]) return;

        if (document.getElementById('level1').value.trim() !== '') {
            showLevelInput('level2', 'level2Label', geoData[country].A2);
            clearLevelInput('level3', 'level3Label');
            populateLevelDatalist('level2', geoData[country].A2Options || []);
        } else {
            clearLevelInput('level2', 'level2Label');
            clearLevelInput('level3', 'level3Label');
        }
    });

    document.getElementById('level2').addEventListener('change', () => {
        const country = countryInput.value;
        if (!geoData[country]) return;

        if (document.getElementById('level2').value.trim() !== '') {
            showLevelInput('level3', 'level3Label', geoData[country].A3);
            populateLevelDatalist('level3', geoData[country].A3Options || []);
        } else {
            clearLevelInput('level3', 'level3Label');
        }
    });
}

function showLevelInput(inputId, labelId, labelText) {
    document.getElementById(labelId).style.display = 'block';
    document.getElementById(labelId).firstElementChild.innerText = labelText + ':';
    document.getElementById(inputId).value = '';
}

function clearLevelInput(inputId, labelId) {
    document.getElementById(labelId).style.display = 'none';
    document.getElementById(inputId).value = '';
}

function populateLevelDatalist(inputId, options) {
    // create or replace datalist for this level
    let input = document.getElementById(inputId);
    let datalistId = inputId + 'List';
    let datalist = document.getElementById(datalistId);
    if (!datalist) {
        datalist = document.createElement('datalist');
        datalist.id = datalistId;
        document.body.appendChild(datalist);
    }
    datalist.innerHTML = '';
    options.forEach(o => {
        let option = document.createElement('option');
        option.value = o;
        datalist.appendChild(option);
    });
    input.setAttribute('list', datalistId);
}

// Map click for lat/lng
var map = L.map('map').setView([-1.2921, 36.8219], 5);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

map.on('click', function(e) {
    document.getElementById('lat').value = e.latlng.lat;
    document.getElementById('lng').value = e.latlng.lng;
});

*/