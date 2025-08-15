<?php 
//app/views/home.php
include 'header.php'; ?>

<h1>Welcome to EpyWiki</h1>

<div class="grid-container">

    <!-- Disease Selection -->
    <div class="grid-left">
        <h2>Select Disease</h2>
        <form method="get">
            <input type="hidden" name="page" value="home">
            <select name="disease_id" onchange="this.form.submit()" required>
                <option value="">-- Choose a disease --</option>
                <?php foreach ($diseases as $disease): ?>
                    <option value="<?= $disease['id'] ?>" <?= $selected_disease_id === (int)$disease['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($disease['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (is_logged_in() && is_approved()): ?>
                <p><a href="?page=disease_list">Manage Diseases</a></p>
            <?php endif; ?>
        </form>
        <br>
        <a href="?page=add_disease">Add new disease</a>
    </div>

    <!-- Epidemiology Table -->
    <div class="grid-right">
        <?php if ($selected_disease_id): ?>
            <h2>Epidemiology for: <?= htmlspecialchars(array_column($diseases, 'name', 'id')[$selected_disease_id]) ?></h2>
            <a href="?page=add_location">Add new location</a>

            <table border="1" cellpadding="6" cellspacing="0">
                <thead>
                    <tr>
                        <th>County</th>
                        <th>Constituency</th>
                        <th>Ward</th>
                        <th>Cases</th>
                        <th>Deaths</th>
                        <th>Report Date</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($locations as $location): 
                        $data = $epi_data[$location['ward_id']] ?? null;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($location['county_name']) ?></td>
                            <td><?= htmlspecialchars($location['constituency_name']) ?></td>
                            <td><?= htmlspecialchars($location['ward_name']) ?></td>
                            <?php if ($data): ?>
                                <td><?= $data['cases'] ?></td>
                                <td><?= $data['deaths'] ?></td>
                                <td><?= $data['report_date'] ?></td>
                                <td><?= $Parsedown->text($data['notes']) ?></td>
                                <td><a href="?page=edit_epi_data&id=<?= $data['id'] ?>">Edit</a></td>
                            <?php else: ?>
                                <td colspan="4" style="text-align:center;">No data available</td>
                                <td>
                                    <a href="?page=edit_epi_data&ward_id=<?= $location['ward_id'] ?>&disease_id=<?= $selected_disease_id ?>">Add</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Please select a disease to view epidemiological data.</p>
        <?php endif; ?>
    </div>
</div>

<hr>

<!-- Add Epidemiological Data Form -->
<div>
    <h2>Add Epidemiological Data</h2>
    <form method="post">
        <label>Disease:</label>
        <select name="disease_id" required>
            <?php foreach ($diseases as $d): ?>
                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Location:</label>
        <select name="location_id" required>
            <?php foreach ($locations as $l): ?>
                <option value="<?= $l['ward_id'] ?>"><?= htmlspecialchars($l['ward_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Cases:</label>
        <input type="number" name="cases" min="0">

        <label>Deaths:</label>
        <input type="number" name="deaths" min="0">

        <label>Report Date:</label>
        <input type="date" name="report_date">

        <label>Notes (Markdown supported):</label>
        <a href="?page=markdown_help">Markdown Help</a>
        <textarea name="notes" placeholder="Example: [WHO 2024](https://www.who.int/malaria)"></textarea>

        <button type="submit" name="add_epi_data">Save Data</button>
    </form>
</div>

