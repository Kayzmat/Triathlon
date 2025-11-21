<div class="page-title">
    <h1>Ajouter un club</h1>
</div>

<?php if (isset($data['error'])): ?>
    <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
        <?= htmlspecialchars($data['error']) ?>
    </div>
<?php endif; ?>

<div class="form-container" style="max-width: 500px; margin: 30px auto; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px #eee; padding: 24px;">
    <form method="POST" action="index.php?module=clubs&action=create">
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="name" style="display:block; margin-bottom:6px;">Nom du club</label>
            <input type="text" name="name" id="name" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <div class="form-group" style="margin-bottom: 16px;">
            <label for="address" style="display:block; margin-bottom:6px;">Adresse</label>
            <input type="text" name="address" id="address" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
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
            <label for="email" style="display:block; margin-bottom:6px;">Email</label>
            <input type="email" name="email" id="email" class="form-control" required style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;">
        </div>
        <button type="submit" class="btn btn-primary btn-darkblue" style="width:100%; padding:10px; border-radius:4px;">Ajouter</button>
    </form>
</div>

<style>
.form-container {
    background: white;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 16px;
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

.btn-primary,
.btn-primary.btn-darkblue {
    background-color: #0056b3;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.btn-primary:hover,
.btn-primary.btn-darkblue:hover {
    background-color: #003d80;
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
