<!-- app/views/diseases/edit_disease.php -->
<?php require __DIR__ . '/../partials/header.php'; ?>

<h2>Edit Disease</h2>

<form method="POST" action="<?= BASE_URL ?>/edit_disease?id=<?= htmlspecialchars($disease['id']) ?>">
    <div>
        <label for="name">Disease Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($disease['name']) ?>" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?= htmlspecialchars($disease['description']) ?></textarea>
    </div>

    <button type="submit">Update Disease</button>
</form>

<?php require __DIR__ . '/../partials/footer.php'; ?>
