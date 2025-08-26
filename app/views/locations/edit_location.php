<?php 
// app/views/locations/edit_location.php
include __DIR__ . '/../partials/header.php'; 
?>
<h1>Edit Location</h1>

<form method="POST" action="<?= BASE_URL ?>/locations/update/<?php echo $location['id']; ?>">

    <label>Country:</label>
    <input type="text" name="country" 
           value="<?php echo htmlspecialchars($location['country'] ?? ''); ?>" required>
    <br><br>

    <label>Level 1:</label>
    <input type="text" name="level1" 
           value="<?php echo htmlspecialchars($location['level1'] ?? ''); ?>">
    <br><br>

    <label>Level 2:</label>
    <input type="text" name="level2" 
           value="<?php echo htmlspecialchars($location['level2'] ?? ''); ?>">
    <br><br>

    <label>Level 3:</label>
    <input type="text" name="level3" 
           value="<?php echo htmlspecialchars($location['level3'] ?? ''); ?>">
    <br><br>

    <button type="submit">Update</button>
</form>

<form method="POST" action="<?= BASE_URL ?>/locations/delete/<?php echo $location['id']; ?>" 
      onsubmit="return confirm('Are you sure?');">

    <button type="submit">Delete</button>
</form>

<?php include __DIR__ . '/../partials/footer.php'; ?>
