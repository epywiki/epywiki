<?php
// app/views/edit_disease.php
include 'header.php';
?>
<h2>Edit Disease</h2>

<form method="post">
    <label for="name">Disease Name:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($disease['name']) ?>" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" rows="4"><?= htmlspecialchars($disease['description']) ?></textarea>

    <button type="submit" name="update_disease">Save Changes</button>
</form>
