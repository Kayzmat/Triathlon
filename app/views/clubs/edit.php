<div class="page-title">
    <h1>Modifier le club</h1>
    <a href="index.php?module=clubs" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la liste
    </a>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<?php if (isset($data['club'])): ?>
<div class="form-container">
    <form method="POST" action="index.php?module=clubs&action=edit&id=<?= $data['club']['id'] ?>">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nom du club *</label>
                <input type="text" id="name" name="name" class="form-control" required
                       value="<?= htmlspecialchars($_POST['name'] ?? $data['club']['name']) ?>">
            </div>

            <div class="form-group">
                <label for="address">Adresse *</label>
                <input type="text" id="address" name="address" class="form-control" required
                       value="<?= htmlspecialchars($_POST['address'] ?? $data['club']['address']) ?>">
            </div>

            <div class="form-group">
                <label for="city">Ville *</label>
                <input type="text" id="city" name="city" class="form-control" required
                       value="<?= htmlspecialchars($_POST['city'] ?? $data['club']['city']) ?>">
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" class="form-control"
                       value="<?= htmlspecialchars($_POST['phone'] ?? $data['club']['phone']) ?>">
            </div>

            <div class="form-group full-width">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="<?= htmlspecialchars($_POST['email'] ?? $data['club']['email']) ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
            <a href="index.php?module=clubs" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>
<?php else: ?>
<div style="background: #fee; color: #c33; padding: 20px; border-radius: 4px; text-align: center;">
    Club non trouvé.
</div>
<?php endif; ?>

<style>
.form-container {
    background: white;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
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
