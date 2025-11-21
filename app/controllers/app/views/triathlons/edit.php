<div class="page-title">
    <h1>Modifier le triathlon</h1>
    <a href="index.php?module=triathlons" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<?php if (isset($data['triathlon'])): ?>
<div class="form-container">
    <form method="POST" action="index.php?module=triathlons&action=edit&id=<?= $data['triathlon']['id'] ?>">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom du triathlon *</label>
                <input type="text" id="name" name="name" class="form-control" required
                       value="<?= htmlspecialchars($_POST['name'] ?? $data['triathlon']['name']) ?>">
            </div>

            <div class="form-group">
                <label for="type">Type *</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">Sélectionner le type</option>
                    <option value="XS" <?= ((isset($_POST['type']) && $_POST['type'] == 'XS') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'XS')) ? 'selected' : '' ?>>XS - Sprint court</option>
                    <option value="S" <?= ((isset($_POST['type']) && $_POST['type'] == 'S') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'S')) ? 'selected' : '' ?>>S - Sprint</option>
                    <option value="M" <?= ((isset($_POST['type']) && $_POST['type'] == 'M') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'M')) ? 'selected' : '' ?>>M - Moyen</option>
                    <option value="L" <?= ((isset($_POST['type']) && $_POST['type'] == 'L') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'L')) ? 'selected' : '' ?>>L - Long</option>
                    <option value="XL" <?= ((isset($_POST['type']) && $_POST['type'] == 'XL') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'XL')) ? 'selected' : '' ?>>XL - Très long</option>
                    <option value="TROP" <?= ((isset($_POST['type']) && $_POST['type'] == 'TROP') || (!isset($_POST['type']) && $data['triathlon']['type'] == 'TROP')) ? 'selected' : '' ?>>TROP - Olympique</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Lieu *</label>
                <input type="text" id="location" name="location" class="form-control" required
                       value="<?= htmlspecialchars($_POST['location'] ?? $data['triathlon']['location']) ?>">
            </div>

            <div class="form-group">
                <label for="event_date">Date de l'événement *</label>
                <input type="date" id="event_date" name="event_date" class="form-control" required
                       value="<?= htmlspecialchars($_POST['event_date'] ?? $data['triathlon']['event_date']) ?>">
            </div>

            <div class="form-group">
                <label for="max_participants">Nombre maximum de participants</label>
                <input type="number" id="max_participants" name="max_participants" class="form-control" min="1"
                       value="<?= htmlspecialchars($_POST['max_participants'] ?? $data['triathlon']['max_participants']) ?>">
            </div>

            <div class="form-group">
                <label for="registration_deadline">Date limite d'inscription</label>
                <input type="date" id="registration_deadline" name="registration_deadline" class="form-control"
                       value="<?= htmlspecialchars($_POST['registration_deadline'] ?? $data['triathlon']['registration_deadline']) ?>">
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          placeholder="Description du triathlon, parcours, particularités..."><?= htmlspecialchars($_POST['description'] ?? $data['triathlon']['description']) ?></textarea>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
            <a href="index.php?module=triathlons" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>
<?php else: ?>
<div style="background: #fee; color: #c33; padding: 20px; border-radius: 4px; text-align: center;">
    Triathlon non trouvé.
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.form-group.full-width {
    grid-column: 1 / -1;
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

textarea.form-control {
    resize: vertical;
    min-height: 100px;
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
