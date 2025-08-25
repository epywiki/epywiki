<?php 
include __DIR__ . '/../views/partials/header.php';
$Parsedown = new Parsedown();
?>

<a href="<?= BASE_URL ?>/locations/add">Add Location</a> |
<a href="<?= BASE_URL ?>/add_disease">Add Disease</a>

<!-- ================= LOCATIONS ================== -->
<h2>Existing Locations</h2>

<?php if (!empty($locations)): ?>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Country</th>
                <th>Level 1</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $loc): ?>
            <tr>
                <td><?= $loc['id'] ?? '' ?></td>
                <td><?= htmlspecialchars($loc['country'] ?? '') ?></td>
                <td><?= htmlspecialchars($loc['level1'] ?? '') ?></td>
                <td><?= htmlspecialchars($loc['level2'] ?? '') ?></td>
                <td><?= htmlspecialchars($loc['level3'] ?? '') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/locations/edit/<?= $loc['id'] ?>">Edit</a> | 
                    <form action="<?= BASE_URL ?>/locations/delete/<?= $loc['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit" onclick="return confirm('Delete this location?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No locations added yet.</p>
<?php endif; ?>


<!-- ================= DISEASES ================== -->
<h2>Existing Diseases</h2>

<?php if (!empty($diseases)): ?>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($diseases as $d): ?>
            <tr>
                <td><?= $d['id'] ?? '' ?></td>
                <td><?= htmlspecialchars($d['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($d['description'] ?? '') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>/edit_disease?id=<?= $d['id'] ?>">Edit</a> | 
                    <a href="<?= BASE_URL ?>/delete_disease?id=<?= $d['id'] ?>" 
                       onclick="return confirm('Delete this disease?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No diseases added yet.</p>
<?php endif; ?>

<!-- ================= REPORTS ================== -->
<h2>Reports</h2>
<a href="<?= BASE_URL ?>/reports/create">Add Report</a> |
<a href="<?= BASE_URL ?>/reports">View All Reports</a>


<div class="container">
    <h2>Reports</h2>
    <a href="<?= BASE_URL ?>/reports/create">+ Create New Report</a>

    <?php if (!empty($reports)): ?>
        <ul>
            <?php foreach ($reports as $report): ?>
                <li>
    <strong><?= htmlspecialchars($report['disease_name']) ?></strong>
    <p>Description: <?= htmlspecialchars($report['disease_description']) ?></p>
    <p>Location: <?= htmlspecialchars($report['country'] . ' ' . $report['level1'] . ' ' . $report['level2'] . ' ' . $report['level3']) ?></p>
    <p>Report: <?= $Parsedown->text($report['content_md']) ?></p>


    <a href="<?= BASE_URL ?>/reports/<?= $report['id'] ?>/edit">Edit</a> |

    <form action="<?= BASE_URL ?>/reports/<?= $report['id'] ?>/delete" method="POST" style="display:inline;">
        <button type="submit" onclick="return confirm('Delete this report?');">Delete</button>
    </form>
</li>

            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No reports found.</p>
    <?php endif; ?>
</div>

<?php 
include __DIR__ . '/../views/partials/footer.php';
?>
