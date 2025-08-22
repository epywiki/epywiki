</main>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([0, 0], 2); // World view
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    document.getElementById('searchBtn').addEventListener('click', function() {
        var query = document.getElementById('searchBox').value;
        if (!query) return;

        fetch("https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    var place = data[0]; // take first match
                    var lat = place.lat;
                    var lon = place.lon;
                    var addr = place.address;

                    // Fill in form fields
                    document.getElementById('country').value = addr.country || '';
                    document.getElementById('state').value = addr.state || '';
                    document.getElementById('county').value = addr.county || addr.region || '';
                    document.getElementById('city').value = addr.city || addr.town || addr.village || addr.suburb || '';

                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lon;

                    // Place marker on map
                    if (marker) map.removeLayer(marker);
                    marker = L.marker([lat, lon]).addTo(map)
                        .bindPopup("<b>" + (addr.city || addr.town || addr.village || query) + "</b><br>" +
                                   (addr.state || '') + ", " + (addr.country || ''))
                        .openPopup();

                    map.setView([lat, lon], 8);
                } else {
                    alert("No results found.");
                }
            })
            .catch(err => console.error(err));
    });
});
</script>

</body>
</html>
