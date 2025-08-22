<?php 
//app/views/locations/add_location.php
include __DIR__ . '/../partials/header.php'; 
?>

<h2>Add Location</h2>

<form method="POST" id="locationForm">
    <label>Search Location:</label>
    <input type="text" id="searchBox" placeholder="Enter city, county, state, etc." style="width:300px;">
    <button type="button" id="searchBtn">Search</button>

    <h3>Selected Administrative Divisions</h3>
    <label>Country: <input type="text" name="country" id="country" readonly></label><br>
    <label>State/Province: <input type="text" name="state" id="state" readonly></label><br>
    <label>County/Region: <input type="text" name="county" id="county" readonly></label><br>
    <label>City/Ward: <input type="text" name="city" id="city" readonly></label><br>

    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="lng" id="lng">

    <button type="submit" name="add_location">Add Location</button>
</form>

<!-- Map container -->
<div id="map" style="height:500px; margin-top:20px;"></div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
<script src="<?= BASE_URL ?>/public/js/map.js"></script>
