<?php
//app/views/add_disease.php
include 'header.php';
?>
<h1>This is where you add the diseases</h1>
<h2>Add Disease</h2>
<form method="post">
    <label>Name:</label>
    <input type="text" name="name" required>
    
    <label>Description:</label>
    <textarea name="description"></textarea>
    
    <button type="submit">Add Disease</button>
</form>
