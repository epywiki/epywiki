<?php
//app/views/reports/report_list.php
include __DIR__ . '/../partials/header.php'; ?>

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

<?php include __DIR__ . '/../partials/footer.php'; ?>
