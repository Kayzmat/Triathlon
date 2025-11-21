<?php
$errors = $data['errors'] ?? [];
$old = $data['old'] ?? [];
$clubs = $data['clubs'] ?? [];
?>
<div class="licence-page"><!-- added wrapper to scope styles -->
<h2>Ajouter un licencié</h2>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
            <?php foreach ($errors as $e): ?><li><?php echo htmlspecialchars($e); ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="form-card">
<form class="licence-form" method="post" action="index.php?module=licencies&action=create">
    <div class="form-grid">
        <label class="field">
            <span class="label-text">Numéro de licence <small>(obligatoire)</small></span>
            <input type="text" name="license_number" value="<?php echo htmlspecialchars($old['license_number'] ?? $old['licence_number'] ?? '') ?>" required>
        </label>

        <label class="field">
            <span class="label-text">Prénom <small>(obligatoire)</small></span>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($old['first_name'] ?? '') ?>" required>
        </label>

        <label class="field">
            <span class="label-text">Nom <small>(obligatoire)</small></span>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($old['last_name'] ?? '') ?>" required>
        </label>

        <label class="field">
            <span class="label-text">Email <small>(obligatoire)</small></span>
            <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? '') ?>" required>
        </label>

        <label class="field">
            <span class="label-text">Date de naissance</span>
            <input type="date" name="birth_date" value="<?php echo htmlspecialchars($old['birth_date'] ?? $old['birthdate'] ?? '') ?>">
        </label>

        <label class="field">
            <span class="label-text">Genre</span>
            <select name="gender">
                <option value="M" <?php echo (isset(
                    $old['gender']) && $old['gender']=='M') ? 'selected' : '' ?>>M</option>
                <option value="F" <?php echo (isset($old['gender']) && $old['gender']=='F') ? 'selected' : '' ?>>F</option>
            </select>
        </label>

        <label class="field">
            <span class="label-text">Catégorie</span>
            <select name="category">
                <?php
                $cats = ['Junior','Senior','Vétéran'];
                foreach ($cats as $c) {
                    $sel = (isset($old['category']) && $old['category']==$c) ? 'selected' : '';
                    echo "<option value=\"" . htmlspecialchars($c) . "\" $sel>" . htmlspecialchars($c) . "</option>";
                }
                ?>
            </select>
        </label>

        <label class="field">
            <span class="label-text">Type de licence</span>
            <select name="license_type">
                <?php
                $types = ['Compétition','Loisir'];
                foreach ($types as $t) {
                    $sel = (isset($old['license_type']) && $old['license_type']==$t) ? 'selected' : '';
                    echo "<option value=\"" . htmlspecialchars($t) . "\" $sel>" . htmlspecialchars($t) . "</option>";
                }
                ?>
            </select>
        </label>

        <label class="field">
            <span class="label-text">Téléphone<small>(obligatoire)</small></span>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($old['phone'] ?? '') ?>" required>
        </label>

        <label class="field full-width">
            <span class="label-text">Club (sélectionnez)</span>
            <select name="club_id" id="club_id">
                <option value="">-- Choisir un club --</option>
                <?php foreach ($clubs as $c):
                    $sel = (isset($old['club_id']) && $old['club_id'] == $c['id']) ? 'selected' : '';
                ?>
                    <option value="<?php echo (int)$c['id'] ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Ajouter</button>
        <a href="index.php?module=licencies" class="btn-link">Annuler</a>
    </div>
</form>
</div>

<script>
document.getElementById('club_id').addEventListener('change', function(){
    var newLabel = document.getElementById('new-club-label');
    if (this.value === 'new') {
        newLabel.style.display = 'block';
    } else {
        newLabel.style.display = 'none';
    }
});
</script>

<style>
:root{
    --card-bg: #ffffff;
    --page-bg: #f5f7fb;
    --accent: #0d6efd;
    --accent-dark: #0b5ed7;
    --muted: #6c757d;
    --danger: #f8d7da;
    --radius: 10px;
    --shadow: 0 6px 18px rgba(28,40,57,0.08);
    --max-width: 920px;
}

/* Page baseline */
body {
    background: var(--page-bg);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    color: #1c2439;
}

/* Header */
.licence-page h2 {
    text-align: center;
    margin: 20px 0 10px;
    font-weight: 700;
    color: #172035;
}

/* Card */
.form-card {
    max-width: var(--max-width);
    margin: 0 auto 40px;
    background: linear-gradient(180deg, rgba(255,255,255,0.98), var(--card-bg));
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 22px;
    border: 1px solid rgba(17,24,39,0.04);
}

/* Errors */
.errors {
    background: var(--danger);
    color: #842029;
    padding: 12px 16px;
    margin-bottom: 16px;
    border-radius: 8px;
    border: 1px solid rgba(220,53,69,0.12);
}
.errors ul { margin: 0; padding-left: 18px; }

/* Grid layout */
.form-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 14px 18px;
}

@media (min-width: 720px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .field.full-width { grid-column: 1 / -1; }
}

/* Fields */
.field { display: flex; flex-direction: column; }
.label-text {
    font-size: 0.9rem;
    margin-bottom: 6px;
    color: #334155;
    font-weight: 600;
}
.field input[type="text"],
.field input[type="email"],
.field input[type="date"],
.field select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e6e9ee;
    border-radius: 8px;
    font-size: 0.95rem;
    background: #fff;
    transition: box-shadow 0.18s, border-color 0.18s, transform 0.08s;
}
.field input:focus,
.field select:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 6px 20px rgba(13,110,253,0.08);
    transform: translateY(-1px);
}

/* Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
}
.btn-primary {
    background: linear-gradient(180deg,var(--accent),var(--accent-dark));
    color: #fff;
    padding: 10px 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-weight: 700;
    box-shadow: 0 6px 18px rgba(13,110,253,0.12);
}
.btn-primary:hover { transform: translateY(-2px); }

.btn-link {
    color: var(--muted);
    text-decoration: none;
    padding: 8px 10px;
    border-radius: 6px;
    font-size: 0.95rem;
}
.btn-link:hover { text-decoration: underline; color: #0b5ed7; }

/* Small helpers */
small { color: #6b7280; font-weight: 500; margin-left: 6px; }

/* Responsive spacing fix for small screens */
@media (max-width: 719px) {
    .form-actions { flex-direction: column-reverse; align-items: stretch; }
    .btn-primary { width: 100%; }
    .btn-link { text-align: center; display: block; padding: 10px 0; }
}
</style>
</div><!-- close .licence-page wrapper -->
