<?php 
include __DIR__ . '/../views/partials/header.php';
?>

<a href="<?= BASE_URL ?>/locations/add">Add Location</a>

<h2>Existing Locations</h2>

<?php if (!empty($locations)): ?>
    <table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Country</th>
            <th>State</th>
            <th>County</th>
            <th>City</th>
            <th>Name</th>
            <th>Type</th>
            <th>Latitude</th>
            <th>Longitude</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($locations as $loc): ?>
        <tr>
            <td><?= $loc['id'] ?? '' ?></td>
            <td><?= htmlspecialchars($loc['country'] ?? '') ?></td>
            <td><?= htmlspecialchars($loc['state'] ?? '') ?></td>
            <td><?= htmlspecialchars($loc['county'] ?? '') ?></td>
            <td><?= htmlspecialchars($loc['city'] ?? '') ?></td>
            <td><?= htmlspecialchars($loc['name'] ?? '') ?></td>
            <td><?= htmlspecialchars($loc['type'] ?? '') ?></td>
            <td><?= $loc['latitude'] ?? '' ?></td>
            <td><?= $loc['longitude'] ?? '' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php else: ?>
    <p>No locations added yet.</p>
<?php endif; ?>

<?php 
include __DIR__ . '/../views/partials/footer.php';
?>
