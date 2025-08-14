<?php
// app/views/edit_api_data.php
include 'header.php';
?>
<h2>Edit Epidemiological Data</h2>
<form method="post">
    <label>Cases:</label>
    <input type="number" name="cases" min="0" value="<?= htmlspecialchars($record['cases']) ?>">

    <label>Deaths:</label>
    <input type="number" name="deaths" min="0" value="<?= htmlspecialchars($record['deaths']) ?>">

    <label>Report Date:</label>
    <input type="date" name="report_date" value="<?= htmlspecialchars($record['report_date']) ?>">

    <label>Notes (use Markdown for references):</label>
    <a href="?page=markdown_help">Markdown Help</a>
    <textarea name="notes" placeholder="Example: Malaria data from [WHO](https://www.who.int/malaria)"><?= htmlspecialchars($record['notes']) ?></textarea>
    <small>You can format text and add clickable references using Markdown syntax.</small>

    <button type="submit">Save Changes</button>
</form>
