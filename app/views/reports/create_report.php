<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Create Report</h2>
    <form action="<?= BASE_URL ?>/reports/store" method="POST">

        <div>
            <label for="disease_id">Disease:</label>
            <select name="disease_id" id="disease_id" required>
                <option value="">-- Select Disease --</option>
                <?php foreach ($diseases as $d): ?>
                    <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="location_id">Location:</label>
            <select name="location_id" id="location_id" required>
                <option value="">-- Select Location --</option>
                <?php foreach ($locations as $loc): ?>
                    <option value="<?= $loc['id'] ?>">
                        <?= htmlspecialchars($loc['country'] . ' ' . ($loc['level1'] ?? '') . ' ' . ($loc['level2'] ?? '') . ' ' . ($loc['level3'] ?? '')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="content_md">Report Content (Markdown):</label>
            <textarea name="content_md" id="content_md" rows="6" required></textarea>
        </div>

        <div>
            <button type="submit">Save Report</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
