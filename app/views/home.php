<?php 
//app/views/home.php

$Parsedown = new Parsedown();

include __DIR__ . '/../views/partials/header.php'; ?>
<div class="container">
  <div class="grid-container">
    
    <!-- Sidebar (compact) -->
    <aside class="grid-left">
      <h3>Quick Actions</h3>
      <a href="<?= BASE_URL ?>/locations/add" class="btn">+ Location</a>
      <a href="<?= BASE_URL ?>/add_disease" class="btn">+ Disease</a>

      <!-- Search Diseases -->
      <h4>Diseases</h4>
      <input type="search" placeholder="Search diseases..." onkeyup="filterTable('diseaseTable', this.value)">
      <table id="diseaseTable">
        <tbody>
          <?php foreach (array_slice($diseases, 0, 5) as $d): ?>
          <tr>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td><a href="<?= BASE_URL ?>/edit_disease/<?= $d['id'] ?>">Edit</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="<?= BASE_URL ?>/disease_list">View all diseases</a>

      <!-- Search Locations -->
      <h4>Locations</h4>
      <input type="search" placeholder="Search locations..." onkeyup="filterTable('locationTable', this.value)">
      <table id="locationTable">
        <tbody>
          <?php foreach (array_slice($locations, 0, 5) as $loc): ?>
          <tr>
            <td><?= htmlspecialchars($loc['country'] ?? '') ?></td>
            <td><a href="<?= BASE_URL ?>/locations/edit/<?= $loc['id'] ?>">Edit</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="<?= BASE_URL ?>/location_list">View all locations</a>
    </aside>

    <!-- Main Content (Reports) -->
    <main class="grid-right">
      <h2>Reports</h2>
      <a href="<?= BASE_URL ?>/reports/create" class="btn">+ Create Report</a>

      <?php if (!empty($reports)): ?>
        <?php foreach ($reports as $report): ?>
          <article class="report-card">
            <h3><?= htmlspecialchars($report['disease_name']) ?></h3>
            <p><strong>Location:</strong> <?= htmlspecialchars($report['country'] . ' ' . $report['level1']) ?></p>
            <p><?= $Parsedown->text($report['content_md']) ?></p>
            <a href="<?= BASE_URL ?>/reports/<?= $report['id'] ?>/edit">Edit</a> |
            <form action="<?= BASE_URL ?>/reports/<?= $report['id'] ?>/delete" method="POST" style="display:inline;">
              <button type="submit" class="btn btn-small" onclick="return confirm('Delete this report?');">Delete</button>
            </form>
          </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No reports found.</p>
      <?php endif; ?>
    </main>
  </div>
</div>
<?php include __DIR__ . '/../views/partials/footer.php'; ?>
