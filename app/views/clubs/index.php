<div class="page-title">
    <h1>Gestion des clubs</h1>
    <!-- Bouton Ajouter un club -->
    <a href="index.php?module=clubs&action=create" class="btn btn-primary">Ajouter un club</a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<?php if ($_GET['action'] ?? '' === 'create'): ?>
    <div class="form-container" style="max-width: 500px; margin: 30px auto; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 24px;">
        <h2 style="margin-bottom: 20px;">Ajouter un club</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="index.php?module=clubs&action=create">
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="name" style="display:block; margin-bottom:6px;">Nom du club</label>
                <input type="text" name="name" id="name" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="city" style="display:block; margin-bottom:6px;">Ville</label>
                <input type="text" name="city" id="city" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="phone" style="display:block; margin-bottom:6px;">Téléphone</label>
                <input type="text" name="phone" id="phone" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label for="licencies_count" style="display:block; margin-bottom:6px;">Nb de licenciés</label>
                <input type="number" id="licencies_count" class="form-control" value="0" disabled style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc; background:#eee;">
                <!-- Ce champ est informatif, il n'est pas envoyé ni enregistré -->
            </div>
            <button type="submit" class="btn btn-success" style="width:100%; padding:10px; border-radius:4px;">Ajouter</button>
        </form>
    </div>
<?php endif; ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nom du club</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Nb de licenciés</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['clubs']) && !empty($data['clubs'])): ?>
                <?php foreach ($data['clubs'] as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['name']) ?></td>
                    <td><?= htmlspecialchars($club['city']) ?></td>
                    <td><?= htmlspecialchars($club['phone']) ?></td>
                    <td><?= $club['licencies_count'] ?? 0 ?></td>
                    <td class="actions">
                        <a href="index.php?module=clubs&action=edit&id=<?= $club['id'] ?>" class="action-btn edit" title="Modifier"><i class="fas fa-edit"></i></a>
                        <a href="index.php?module=clubs&action=delete&id=<?= $club['id'] ?>" class="action-btn delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce club ?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Aucun club trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>