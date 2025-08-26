<?php 
// app/views/locations/location_list.php
include __DIR__ . '/../partials/header.php'; 
?>

<div class="container">
  <h2>All Locations</h2>

  <a href="<?= BASE_URL ?>/locations/add" class="btn btn-primary">+ Add Location</a>

  <?php if (!empty($locations)): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Country</th>
          <th>Level 1</th>
          <th>Level 2</th>
          <th>Level 3</th>
          <th>Breadcrumb</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($locations as $loc): ?>
          <tr>
            <td><?= htmlspecialchars($loc['id']) ?></td>
            <td><?= htmlspecialchars($loc['country']) ?></td>
            <td><?= htmlspecialchars($loc['level1']) ?></td>
            <td><?= htmlspecialchars($loc['level2']) ?></td>
            <td><?= htmlspecialchars($loc['level3']) ?></td>
            <td>
              <?= htmlspecialchars(
                implode(" > ", array_filter([
                  $loc['country'],
                  $loc['level1'],
                  $loc['level2'],
                  $loc['level3']
                ]))
              ) ?>
            </td>
            <td>
              <a href="<?= BASE_URL ?>/locations/edit/<?= $loc['id'] ?>" class="btn btn-small">Edit</a>
              <form action="<?= BASE_URL ?>/locations/delete/<?= $loc['id'] ?>" method="POST" style="display:inline;">
                <button type="submit" class="btn btn-small" onclick="return confirm('Delete this location?');">
                  Delete
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No locations found.</p>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
