<?php 
//app/views/add_location.php
include 'header.php'; ?>
<h2>Add Location</h2>
<p>Select a county, constituency, and ward. You can also add deeper levels later.</p>

<form method="post" action="">
    <label>County:</label>
    <select id="county" name="county" required>
        <option value="">Select County</option>
    </select>

    <label>Constituency:</label>
    <select id="constituency" name="constituency" required>
        <option value="">Select Constituency</option>
    </select>

    <label>Ward:</label>
    <select id="ward" name="ward" required>
        <option value="">Select Ward</option>
    </select>

    <button type="submit">Add Location</button>
</form>

<script>
    fetch('data/kenya.json')
    .then(res => res.json())
    .then(json => {
        const countySelect = document.getElementById('county');
        const constituencySelect = document.getElementById('constituency');
        const wardSelect = document.getElementById('ward');

        // Utility: remove all options and add default
        function resetSelect(selectEl, defaultText) {
            while (selectEl.firstChild) selectEl.removeChild(selectEl.firstChild);
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = defaultText;
            selectEl.appendChild(defaultOption);
        }

        // Populate counties
        json.forEach(county => {
            const option = document.createElement('option');
            option.value = county.county_name;
            option.textContent = county.county_name;
            countySelect.appendChild(option);
        });

        // On county change → populate constituencies
        countySelect.addEventListener('change', () => {
            const selectedCounty = json.find(c => c.county_name === countySelect.value);
            resetSelect(constituencySelect, 'Select Constituency');
            resetSelect(wardSelect, 'Select Ward');

            if (selectedCounty) {
                selectedCounty.constituencies.forEach(cons => {
                    const option = document.createElement('option');
                    option.value = cons.constituency_name;
                    option.textContent = cons.constituency_name;
                    constituencySelect.appendChild(option);
                });
            }
        });

        // On constituency change → populate wards
        constituencySelect.addEventListener('change', () => {
            const selectedCounty = json.find(c => c.county_name === countySelect.value);
            const selectedCons = selectedCounty?.constituencies.find(
                cons => cons.constituency_name === constituencySelect.value
            );
            resetSelect(wardSelect, 'Select Ward');

            selectedCons?.wards.forEach(ward => {
                const option = document.createElement('option');
                option.value = ward;
                option.textContent = ward;
                wardSelect.appendChild(option);
            });
        });
    })
    .catch(err => console.error("Error loading JSON:", err));

</script>    
