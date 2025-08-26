<?php 
include __DIR__ . '/../partials/header.php'; 
?>

<h2>Add Location</h2>

<form method="POST" id="locationForm">

    <label>Country:
    <select name="country" id="country">
        <option value="">Select country</option>
    </select>
</label><br>

<label id="level1Label" style="display:none;">Level 1:
    <input type="text" name="level1" id="level1">
</label><br>

<label id="level2Label" style="display:none;">Level 2:
    <input type="text" name="level2" id="level2">
</label><br>

<label id="level3Label" style="display:none;">Level 3:
    <input type="text" name="level3" id="level3">
</label>



    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

    <button type="submit" name="add_location">Add Location</button>
</form>

<div id="map" style="height:500px; margin-top:20px;"></div>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
let geoData = {};

// Load JSON
fetch('<?= BASE_URL ?>/data/africa.json')
  .then(res => res.json())
  .then(data => {
    geoData = data;
    populateCountries();
  })
  .catch(err => console.error("Failed to load JSON:", err));

function populateCountries() {
    const countrySelect = document.getElementById('country');
    Object.keys(geoData).forEach(country => {
        const opt = document.createElement('option');
        opt.value = country;
        opt.textContent = country;
        countrySelect.appendChild(opt);
    });
}

// Update labels when country changes
document.getElementById('country').addEventListener('change', () => {
    const country = document.getElementById('country').value;
    if (!geoData[country]) return;

    // Update labels automatically
    document.getElementById('level1Label').style.display = 'block';
    document.getElementById('level1Label').firstChild.textContent = geoData[country].A1 + ':';
    document.getElementById('level1').value = '';

    document.getElementById('level2Label').style.display = 'block';
    document.getElementById('level2Label').firstChild.textContent = geoData[country].A2 + ':';
    document.getElementById('level2').value = '';

    document.getElementById('level3Label').style.display = 'block';
    document.getElementById('level3Label').firstChild.textContent = geoData[country].A3 + ':';
    document.getElementById('level3').value = '';
});



</script>
