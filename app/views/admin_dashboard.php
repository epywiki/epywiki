<?php
//app/views/admin_dashboard.php
include 'header.php'; 
?>   
<div> 
<div class="container">
    <h1>Admin Dashboard</h1>
    <h2>User Management</h2>
   <table>
    <tr>
        <th>Email</th>
        <th>Admin</th>
        <th>Approved</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
        <td><?= $user['is_approved'] ? 'Yes' : 'No' ?></td>
        <td>
            <?php if (!$user['is_admin']): ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <?php if (!$user['is_approved']): ?>
                        <button type="submit" name="approve">Approve</button>
                    <?php endif; ?>
                    <button type="submit" name="remove">Remove</button>
                </form>
            <?php else: ?>
                Admin account
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</div>
</div>

    

<div class="container">
    

    <!-- Pending requests -->
    <h3>Pending Editor Requests</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <?php if (!$user['is_approved'] && !$user['is_admin']): ?>
                <tr>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" name="approve">Approve</button>
                            <button type="submit" name="remove">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

    <!-- All approved editors -->
    <h3>All Editors</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Email</th>
            <th>Approved</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <?php if (!$user['is_admin']): ?>
                <tr>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['is_approved'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <?php if (!$user['is_approved']): ?>
                                <button type="submit" name="approve">Approve</button>
                            <?php endif; ?>
                            <button type="submit" name="remove">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
            </div>

<body>
</html>    


