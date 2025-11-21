<div class="page-title">
    <h1>Paramètres</h1>
</div>

<div class="settings-container">
    <div class="settings-sidebar">
        <ul class="settings-nav">
            <li class="active" data-tab="profile">Profil</li>
            <li data-tab="security">Sécurité</li>
            <li data-tab="preferences">Préférences</li>
            <li data-tab="notifications">Notifications</li>
        </ul>
    </div>

    <div class="settings-content">
        <!-- Onglet Profil -->
        <div id="profile-tab" class="settings-tab active">
            <h2>Informations du profil</h2>

            <?php if (isset($data['success'])): ?>
                <div style="background: #efe; color: #363; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                    <?= htmlspecialchars($data['success']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($data['error'])): ?>
                <div style="background: #fee; color: #c33; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                    <?= htmlspecialchars($data['error']) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?module=settings&action=updateProfile">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="club_name">Nom du club</label>
                        <input type="text" id="club_name" name="club_name" class="form-control"
                               value="<?= htmlspecialchars($_SESSION['user']['club_name'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Mettre à jour le profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Onglet Sécurité -->
        <div id="security-tab" class="settings-tab">
            <h2>Paramètres de sécurité</h2>

            <div class="security-section">
                <h3>Changer le mot de passe</h3>
                <form method="POST" action="index.php?module=settings&action=changePassword">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="current_password">Mot de passe actuel</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">Nouveau mot de passe</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required minlength="8">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="8">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn">
                            <i class="fas fa-key"></i> Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <div class="security-section">
                <h3>Sessions actives</h3>
                <div class="session-info">
                    <p><strong>Session actuelle :</strong> <?= date('d/m/Y H:i', $_SESSION['user']['login_time'] ?? time()) ?></p>
                    <p><strong>Adresse IP :</strong> <?= $_SERVER['REMOTE_ADDR'] ?></p>
                    <p><strong>Navigateur :</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?></p>
                </div>
                <button class="btn btn-danger" onclick="logoutOtherSessions()">
                    <i class="fas fa-sign-out-alt"></i> Déconnecter toutes les autres sessions
                </button>
            </div>
        </div>

        <!-- Onglet Préférences -->
        <div id="preferences-tab" class="settings-tab">
            <h2>Préférences d'affichage</h2>

            <form method="POST" action="index.php?module=settings&action=updatePreferences">
                <div class="preference-section">
                    <h3>Thème</h3>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="theme" value="light" checked>
                            <span>Thème clair</span>
                        </label>
                        <label>
                            <input type="radio" name="theme" value="dark">
                            <span>Thème sombre</span>
                        </label>
                    </div>
                </div>

                <div class="preference-section">
                    <h3>Langue</h3>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="language" value="fr" checked>
                            <span>Français</span>
                        </label>
                        <label>
                            <input type="radio" name="language" value="en">
                            <span>English</span>
                        </label>
                    </div>
                </div>

                <div class="preference-section">
                    <h3>Format de date</h3>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="date_format" value="d/m/Y" checked>
                            <span>JJ/MM/AAAA</span>
                        </label>
                        <label>
                            <input type="radio" name="date_format" value="m/d/Y">
                            <span>MM/JJ/AAAA</span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Enregistrer les préférences
                    </button>
                </div>
            </form>
        </div>

        <!-- Onglet Notifications -->
        <div id="notifications-tab" class="settings-tab">
            <h2>Paramètres de notifications</h2>

            <form method="POST" action="index.php?module=settings&action=updateNotifications">
                <div class="notification-section">
                    <h3>Email</h3>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="email_new_registration" checked>
                            <span>Nouvelles inscriptions aux triathlons</span>
                        </label>
                        <label>
                            <input type="checkbox" name="email_results" checked>
                            <span>Publication des résultats</span>
                        </label>
                        <label>
                            <input type="checkbox" name="email_reminders">
                            <span>Rappels d'événements</span>
                        </label>
                        <label>
                            <input type="checkbox" name="email_newsletter">
                            <span>Newsletter FFTRI</span>
                        </label>
                    </div>
                </div>

                <div class="notification-section">
                    <h3>Notifications push</h3>
                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="push_urgent" checked>
                            <span>Notifications urgentes</span>
                        </label>
                        <label>
                            <input type="checkbox" name="push_events">
                            <span>Événements à venir</span>
                        </label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> Enregistrer les paramètres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.settings-container {
    display: flex;
    gap: 30px;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.settings-sidebar {
    width: 250px;
    background: var(--light-gray);
    border-right: 1px solid var(--medium-gray);
}

.settings-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.settings-nav li {
    padding: 15px 20px;
    cursor: pointer;
    border-bottom: 1px solid var(--medium-gray);
    transition: background-color 0.3s;
}

.settings-nav li:hover {
    background: rgba(0, 51, 160, 0.1);
}

.settings-nav li.active {
    background: var(--fftri-blue);
    color: white;
}

.settings-content {
    flex: 1;
    padding: 30px;
}

.settings-tab {
    display: none;
}

.settings-tab.active {
    display: block;
}

.settings-tab h2 {
    color: var(--fftri-blue);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--fftri-blue);
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
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
    margin-top: 20px;
}

.security-section, .preference-section, .notification-section {
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--medium-gray);
}

.security-section h3, .preference-section h3, .notification-section h3 {
    color: var(--text-color);
    margin-bottom: 15px;
}

.session-info {
    background: var(--light-gray);
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 15px;
}

.radio-group, .checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.radio-group label, .checkbox-group label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.btn-danger {
    background-color: var(--fftri-red);
    color: white;
}

.btn-danger:hover {
    background-color: #b3002b;
}

@media (max-width: 768px) {
    .settings-container {
        flex-direction: column;
    }

    .settings-sidebar {
        width: 100%;
    }

    .settings-nav {
        display: flex;
        overflow-x: auto;
    }

    .settings-nav li {
        white-space: nowrap;
        border-bottom: none;
        border-right: 1px solid var(--medium-gray);
    }

    .form-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
// Navigation entre les onglets
document.querySelectorAll('.settings-nav li').forEach(tab => {
    tab.addEventListener('click', function() {
        // Retirer la classe active de tous les onglets
        document.querySelectorAll('.settings-nav li').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.settings-tab').forEach(content => content.classList.remove('active'));

        // Ajouter la classe active à l'onglet cliqué
        this.classList.add('active');
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId + '-tab').classList.add('active');
    });
});

function logoutOtherSessions() {
    if (confirm('Êtes-vous sûr de vouloir déconnecter toutes les autres sessions ?')) {
        // TODO: Implémenter la déconnexion des autres sessions
        alert('Fonctionnalité à implémenter');
    }
}
</script>
