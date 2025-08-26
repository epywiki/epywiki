<!-- app/views/diseases/edit_disease.php -->
<?php include __DIR__ . '/../partials/header.php'; ?>

<h2>Edit Disease</h2>
<form method="POST" action="">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($disease['name']) ?>" required>
    <br>

    <label>Description:</label>
    <textarea name="description"><?= htmlspecialchars($disease['description']) ?></textarea>
    <br>

    <button type="submit">Update</button>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
