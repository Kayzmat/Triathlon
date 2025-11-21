<div class="page-title">
    <h1>Modifier le licencié</h1>
    <a href="index.php?module=licencies" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<?php if (isset($data['licencie'])): ?>
<div class="form-container">
    <form method="POST" action="index.php?module=licencies&action=edit&id=<?= $data['licencie']['id'] ?>">
        <div class="form-grid">
            <div class="form-group">
                <label for="license_number">Numéro de licence *</label>
                <input type="text" id="license_number" name="license_number" class="form-control" required
                       value="<?= htmlspecialchars($_POST['license_number'] ?? $data['licencie']['license_number']) ?>">
            </div>

            <div class="form-group">
                <label for="first_name">Prénom *</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required
                       value="<?= htmlspecialchars($_POST['first_name'] ?? $data['licencie']['first_name']) ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Nom *</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required
                       value="<?= htmlspecialchars($_POST['last_name'] ?? $data['licencie']['last_name']) ?>">
            </div>

            <div class="form-group">
                <label for="birth_date">Date de naissance *</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required
                       value="<?= htmlspecialchars($_POST['birth_date'] ?? $data['licencie']['birth_date']) ?>">
            </div>

            <div class="form-group">
                <label for="gender">Genre *</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="">Sélectionner</option>
                    <option value="M" <?= ((isset($_POST['gender']) && $_POST['gender'] == 'M') || (!isset($_POST['gender']) && $data['licencie']['gender'] == 'M')) ? 'selected' : '' ?>>Homme</option>
                    <option value="F" <?= ((isset($_POST['gender']) && $_POST['gender'] == 'F') || (!isset($_POST['gender']) && $data['licencie']['gender'] == 'F')) ? 'selected' : '' ?>>Femme</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Catégorie *</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">Sélectionner</option>
                    <option value="Junior" <?= ((isset($_POST['category']) && $_POST['category'] == 'Junior') || (!isset($_POST['category']) && $data['licencie']['category'] == 'Junior')) ? 'selected' : '' ?>>Junior</option>
                    <option value="Senior" <?= ((isset($_POST['category']) && $_POST['category'] == 'Senior') || (!isset($_POST['category']) && $data['licencie']['category'] == 'Senior')) ? 'selected' : '' ?>>Senior</option>
                    <option value="Vétéran" <?= ((isset($_POST['category']) && $_POST['category'] == 'Vétéran') || (!isset($_POST['category']) && $data['licencie']['category'] == 'Vétéran')) ? 'selected' : '' ?>>Vétéran</option>
                </select>
            </div>

            <div class="form-group">
                <label for="license_type">Type de licence *</label>
                <select id="license_type" name="license_type" class="form-control" required>
                    <option value="">Sélectionner</option>
                    <option value="Compétition" <?= ((isset($_POST['license_type']) && $_POST['license_type'] == 'Compétition') || (!isset($_POST['license_type']) && $data['licencie']['license_type'] == 'Compétition')) ? 'selected' : '' ?>>Compétition</option>
                    <option value="Loisir" <?= ((isset($_POST['license_type']) && $_POST['license_type'] == 'Loisir') || (!isset($_POST['license_type']) && $data['licencie']['license_type'] == 'Loisir')) ? 'selected' : '' ?>>Loisir</option>
                </select>
            </div>

            <div class="form-group">
                <label for="club_id">Club *</label>
                <select id="club_id" name="club_id" class="form-control" required>
                    <option value="">Sélectionner un club</option>
                    <?php if (isset($data['clubs'])): ?>
                        <?php foreach ($data['clubs'] as $club): ?>
                            <option value="<?= $club['id'] ?>" <?= ((isset($_POST['club_id']) && $_POST['club_id'] == $club['id']) || (!isset($_POST['club_id']) && $data['licencie']['club_id'] == $club['id'])) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($club['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($_POST['email'] ?? $data['licencie']['email']) ?>">
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" class="form-control"
                       value="<?= htmlspecialchars($_POST['phone'] ?? $data['licencie']['phone']) ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
            <a href="index.php?module=licencies" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>
<?php else: ?>
<div style="background: #fee; color: #c33; padding: 20px; border-radius: 4px; text-align: center;">
    Licencié non trouvé.
</div>
<?php endif; ?>

<style>
.form-container {
    background: white;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 1000px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-color);
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--medium-gray);
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: var(--fftri-blue);
    outline: none;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-secondary {
    background-color: var(--dark-gray);
    color: white;
}

.btn-secondary:hover {
    background-color: #333;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-actions {
        flex-direction: column;
    }
}
</style>
