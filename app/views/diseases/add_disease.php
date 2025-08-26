<!-- app/views/diseases/add_disease.php -->
<?php require __DIR__ . '/../partials/header.php'; ?>

<h2>Add Disease</h2>

<form method="POST" action="<?= BASE_URL ?>/add_disease">
    <div>
        <label for="name">Disease Name:</label>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <button type="submit">Add Disease</button>
</form>

<?php require __DIR__ . '/../partials/footer.php'; ?>
