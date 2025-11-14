<div class="page-title">
    <h1>Gestion des clubs</h1>
    <a href="index.php?module=clubs&action=create" class="btn">
        <i class="fas fa-plus"></i> Ajouter un club
    </a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
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
