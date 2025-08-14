<?php
//app/views/disease_list.php
include 'header.php';
?>
<h2>Disease List</h2>
<ul>
<?php foreach ($diseases as $disease): ?>
    <li>
        <?= htmlspecialchars($disease['name']) ?>
        - <a href="index.php?page=edit_disease&id=<?= $disease['id'] ?>">Edit</a>
        - <a href="index.php?page=delete_disease&id=<?= $disease['id'] ?>" 
             onclick="return confirm('Are you sure?')">Delete</a>
    </li>
<?php endforeach; ?>
</ul>

