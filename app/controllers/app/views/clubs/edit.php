<div class="page-title">
    <h1>Modifier le club</h1>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<?php if (isset($data['club'])): ?>
<div class="form-container" style="max-width: 500px; margin: 30px auto; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 24px;">
    <form method="POST" action="index.php?module=clubs&action=edit&id=<?= $data['club']['id'] ?>">
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="name" style="display:block; margin-bottom:6px;">Nom du club</label>
            <input type="text" name="name" id="name" class="form-control" required value="<?= htmlspecialchars($data['club']['name']) ?>" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="address" style="display:block; margin-bottom:6px;">Adresse</label>
            <input type="text" name="address" id="address" class="form-control" required value="<?= htmlspecialchars($data['club']['address']) ?>" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="city" style="display:block; margin-bottom:6px;">Ville</label>
            <input type="text" name="city" id="city" class="form-control" required value="<?= htmlspecialchars($data['club']['city']) ?>" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="phone" style="display:block; margin-bottom:6px;">Téléphone</label>
            <input type="text" name="phone" id="phone" class="form-control" required value="<?= htmlspecialchars($data['club']['phone']) ?>" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="email" style="display:block; margin-bottom:6px;">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($data['club']['email']) ?>" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <button type="submit" class="btn btn-primary btn-darkblue" style="width:100%; padding:10px; border-radius:4px;">Enregistrer</button>
    </form>
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
