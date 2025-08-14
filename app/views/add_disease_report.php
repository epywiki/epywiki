<?php
//app/views/add_disease_report.php
include 'header.php';
?>
<h2>Add Disease Report</h2>
<form method="post">
    <label>Disease:</label>
    <select name="disease_id">
        <?php foreach ($diseases as $d): ?>
            <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Location:</label>
    <select name="location_id">
        <?php foreach ($locations as $l): ?>
            <option value="<?= $l['id'] ?>"><?= htmlspecialchars($l['name']) ?> (<?= htmlspecialchars($l['type']) ?>)</option>
        <?php endforeach; ?>
    </select>

    <label>Cases:</label>
    <input type="number" name="cases" required>

    <label>Date:</label>
    <input type="date" name="report_date" required>

    <button type="submit">Add Report</button>
</form>
