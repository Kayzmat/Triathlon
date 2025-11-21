<div class="page-title">
    <h1>Gestion des licenciés</h1>
    <a href="index.php?module=licencies&action=create" class="btn">
        <i class="fas fa-plus"></i> Ajouter un licencié
    </a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<form method="GET" action="index.php" style="margin-bottom: 20px;">
    <input type="hidden" name="module" value="licencies">
    <div class="filters">
        <div class="filter-group">
            <label>Club</label>
            <select name="club_id" class="form-control">
                <option value="">Tous les clubs</option>
                <?php if (isset($data['clubs'])): ?>
                    <?php foreach ($data['clubs'] as $club): ?>
                        <option value="<?= $club['id'] ?>" <?= (isset($data['filters']['club_id']) && $data['filters']['club_id'] == $club['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($club['name']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="filter-group">
            <label>Catégorie</label>
            <select name="category" class="form-control">
                <option value="">Toutes les catégories</option>
                <option value="Junior" <?= (isset($data['filters']['category']) && $data['filters']['category'] == 'Junior') ? 'selected' : '' ?>>Junior</option>
                <option value="Senior" <?= (isset($data['filters']['category']) && $data['filters']['category'] == 'Senior') ? 'selected' : '' ?>>Senior</option>
                <option value="Vétéran" <?= (isset($data['filters']['category']) && $data['filters']['category'] == 'Vétéran') ? 'selected' : '' ?>>Vétéran</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Type de licence</label>
            <select name="license_type" class="form-control">
                <option value="">Tous les types</option>
                <option value="Compétition" <?= (isset($data['filters']['license_type']) && $data['filters']['license_type'] == 'Compétition') ? 'selected' : '' ?>>Compétition</option>
                <option value="Loisir" <?= (isset($data['filters']['license_type']) && $data['filters']['license_type'] == 'Loisir') ? 'selected' : '' ?>>Loisir</option>
            </select>
        </div>
        <div class="filter-group">
            <label>&nbsp;</label>
            <button type="submit" class="btn">Filtrer</button>
        </div>
    </div>
</form>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro licence</th>
                <th>Catégorie</th>
                <th>Type de licence</th>
                <th>Club</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['licencies']) && !empty($data['licencies'])): ?>
                <?php foreach ($data['licencies'] as $licencie): ?>
                <tr>
                    <td><?= htmlspecialchars($licencie['last_name']) ?></td>
                    <td><?= htmlspecialchars($licencie['first_name']) ?></td>
                    <td><?= htmlspecialchars($licencie['license_number']) ?></td>
                    <td><?= htmlspecialchars($licencie['category']) ?></td>
                    <td><?= htmlspecialchars($licencie['license_type']) ?></td>
                    <td><?= htmlspecialchars($licencie['club_name']) ?></td>
                    <td class="actions">
                        <a href="index.php?module=licencies&action=edit&id=<?= $licencie['id'] ?>" class="action-btn edit"><i class="fas fa-edit"></i></a>
                        <a href="index.php?module=licencies&action=delete&id=<?= $licencie['id'] ?>" class="action-btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce licencié ?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Aucun licencié trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
