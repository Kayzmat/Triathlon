<div class="page-title">
    <h1>Tableau de bord <?= $_SESSION['user']['role'] === 'admin' ? 'Administrateur' : 'Responsable Club' ?></h1>
</div>

<?php if ($_SESSION['user']['role'] === 'admin'): ?>
<!-- Dashboard Admin -->
<div class="stats-container">
    <div class="stat-card">
        <i class="fas fa-building"></i>
        <h3><?= $data['clubs_count'] ?? 0 ?></h3>
        <p>Clubs affiliés</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-flag-checkered"></i>
        <h3><?= $data['triathlons_count'] ?? 0 ?></h3>
        <p>Triathlons à venir</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3><?= $data['licencies_count'] ?? 0 ?></h3>
        <p>Licenciés actifs</p>
    </div>
</div>

<div class="table-container">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3>Derniers clubs ajoutés</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nom du club</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Licenciés</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($data['recent_clubs']) && !empty($data['recent_clubs'])): ?>
                <?php foreach ($data['recent_clubs'] as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['name']) ?></td>
                    <td><?= htmlspecialchars($club['city']) ?></td>
                    <td><?= htmlspecialchars($club['phone']) ?></td>
                    <td><?= $club['licencies_count'] ?? 0 ?></td>
                    <td class="actions">
                        <a href="index.php?module=clubs&action=edit&id=<?= $club['id'] ?>" class="action-btn edit"><i class="fas fa-edit"></i></a>
                        <a href="index.php?module=clubs&action=delete&id=<?= $club['id'] ?>" class="action-btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce club ?')"><i class="fas fa-trash"></i></a>
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

<?php else: ?>
<!-- Dashboard Responsable Club -->
<div class="stats-container">
    <div class="stat-card">
        <i class="fas fa-users"></i>
        <h3><?= $data['licencies_count'] ?? 0 ?></h3>
        <p>Licenciés</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-flag-checkered"></i>
        <h3><?= $data['registrations_count'] ?? 0 ?></h3>
        <p>Inscriptions en cours</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-trophy"></i>
        <h3><?= $data['results_count'] ?? 0 ?></h3>
        <p>Résultats cette saison</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;">
    <div class="table-container">
        <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <h3>Mes licenciés</h3>
            <a href="index.php?module=licencies&action=create" class="btn">Ajouter un licencié</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Licence</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($data['my_licencies']) && !empty($data['my_licencies'])): ?>
                    <?php foreach ($data['my_licencies'] as $licencie): ?>
                    <tr>
                        <td><?= htmlspecialchars($licencie['last_name']) ?></td>
                        <td><?= htmlspecialchars($licencie['first_name']) ?></td>
                        <td><?= htmlspecialchars($licencie['license_number']) ?></td>
                        <td><?= htmlspecialchars($licencie['category']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucun licencié trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="table-container">
        <div style="padding: 20px; border-bottom: 1px solid #eee;">
            <h3>Inscriptions aux triathlons</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Triathlon</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($data['my_registrations']) && !empty($data['my_registrations'])): ?>
                    <?php foreach ($data['my_registrations'] as $registration): ?>
                    <tr>
                        <td><?= htmlspecialchars($registration['triathlon_name']) ?></td>
                        <td><?= htmlspecialchars($registration['event_date']) ?></td>
                        <td><?= htmlspecialchars($registration['location']) ?></td>
                        <td><span style="color: <?= $registration['status'] === 'Inscrit' ? 'green' : 'orange' ?>;"><?= htmlspecialchars($registration['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Aucune inscription trouvée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
