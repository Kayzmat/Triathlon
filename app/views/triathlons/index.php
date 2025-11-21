<div class="page-title">
    <h1>Gestion des triathlons</h1>
    <a href="index.php?module=triathlons&action=create" class="btn">
        <i class="fas fa-plus"></i> Créer un triathlon
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
                <th>Nom</th>
                <th>Type</th>
                <th>Lieu</th>
                <th>Date</th>
                <th>Nb inscrits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['triathlons']) && !empty($data['triathlons'])): ?>
                <?php foreach ($data['triathlons'] as $triathlon): ?>
                <tr>
                    <td><a href="index.php?module=triathlons&action=show&id=<?= $triathlon['id'] ?>" style="color: var(--fftri-blue); text-decoration: none;"><?= htmlspecialchars($triathlon['name']) ?></a></td>
                    <td><?= htmlspecialchars($triathlon['type']) ?></td>
                    <td><?= htmlspecialchars($triathlon['location']) ?></td>
                    <td><?= date('d/m/Y', strtotime($triathlon['event_date'])) ?></td>
                    <td><?= $triathlon['participants_count'] ?? 0 ?></td>
                    <td class="actions">
                        <a href="index.php?module=triathlons&action=edit&id=<?= $triathlon['id'] ?>" class="action-btn edit"><i class="fas fa-edit"></i></a>
                        <a href="index.php?module=triathlons&action=delete&id=<?= $triathlon['id'] ?>" class="action-btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce triathlon ?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Aucun triathlon trouvé</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
