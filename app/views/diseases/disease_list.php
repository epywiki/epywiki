<!-- app/views/diseases/disease_list.php -->
<?php require __DIR__ . '/../partials/header.php'; ?>

<h2>Disease List</h2>

<a href="<?= BASE_URL ?>/add_disease">+ Add New Disease</a>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($diseases as $d): ?>
        <tr>
            <td><?= htmlspecialchars($d['id']) ?></td>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td><?= htmlspecialchars($d['description']) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/edit_disease?id=<?= $d['id'] ?>">Edit</a> | 
                <a href="<?= BASE_URL ?>/delete_disease?id=<?= $d['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this disease?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../partials/footer.php'; ?>
