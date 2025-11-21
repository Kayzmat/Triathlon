<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FFTRI - Gestion des Triathlons</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --fftri-blue: #0033A0;
            --fftri-red: #D50032;
            --white: #FFFFFF;
            --light-gray: #F6F6F6;
            --medium-gray: #E0E0E0;
            --dark-gray: #555555;
            --text-color: #333333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--text-color);
            background-color: var(--light-gray);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--fftri-blue);
            color: var(--white);
            padding: 20px 0;
        }
        
        .logo {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 20px;
            text-align: center;
        }
        
        .logo h2 {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        
        .nav-links {
            list-style: none;
        }
        
        .nav-links li {
            padding: 12px 20px;
            transition: all 0.3s;
        }
        
        .nav-links li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-links li.active {
            background-color: var(--fftri-red);
        }
        
        .nav-links a {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .nav-links i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background-color: var(--white);
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            background: var(--fftri-blue);
        }
        
        .content {
            padding: 30px;
            flex: 1;
            overflow-y: auto;
        }
        
        .page-title {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title h1 {
            color: var(--fftri-blue);
            font-size: 1.8rem;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: var(--fftri-blue);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        
        .btn:hover {
            background-color: #00257a;
        }
        
        .btn-danger {
            background-color: var(--fftri-red);
        }
        
        .btn-danger:hover {
            background-color: #b3002b;
        }
        
        /* Dashboard */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: var(--white);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .stat-card i {
            font-size: 2rem;
            color: var(--fftri-blue);
            margin-bottom: 10px;
        }
        
        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .stat-card p {
            color: var(--dark-gray);
        }
        
        /* Tables */
        .table-container {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: var(--fftri-blue);
            color: var(--white);
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        tbody tr:hover {
            background-color: rgba(0, 51, 160, 0.05);
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: var(--dark-gray);
            transition: color 0.3s;
        }
        
        .action-btn.edit:hover {
            color: var(--fftri-blue);
        }
        
        .action-btn.delete:hover {
            color: var(--fftri-red);
        }
        
        /* Login Page */
        .login-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 51, 160, 0.8), rgba(0, 51, 160, 0.9));
            background-size: cover;
            align-items: center;
            justify-content: center;
        }
        
        .login-box {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo h1 {
            color: var(--fftri-blue);
            margin-top: 10px;
            font-size: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 20px;
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
        
        .btn-block {
            display: block;
            width: 100%;
        }
        
        .error {
            color: var(--fftri-red);
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(213, 0, 50, 0.1);
            border-radius: 4px;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .nav-links {
                display: flex;
                overflow-x: auto;
            }
            
            .nav-links li {
                white-space: nowrap;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <div style="width: 120px; height: 60px; background: white; margin: 0 auto; display: flex; align-items: center; justify-content: center; color: var(--fftri-blue); font-weight: bold;">LOGO FFTRI</div>
                <h2>Gestion des Triathlons</h2>
            </div>
            <ul class="nav-links">
                <li class="<?= $currentPage === 'dashboard' ? 'active' : '' ?>">
                    <a href="index.php?module=dashboard">
                        <i class="fas fa-home"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li class="<?= $currentPage === 'clubs' ? 'active' : '' ?>">
                    <a href="index.php?module=clubs">
                        <i class="fas fa-building"></i>
                        <span>Clubs</span>
                    </a>
                </li>
                <li class="<?= $currentPage === 'licencies' ? 'active' : '' ?>">
                    <a href="index.php?module=licencies">
                        <i class="fas fa-users"></i>
                        <span>Licenciés</span>
                    </a>
                </li>
                <li class="<?= $currentPage === 'triathlons' ? 'active' : '' ?>">
                    <a href="index.php?module=triathlons">
                        <i class="fas fa-flag-checkered"></i>
                        <span>Triathlons</span>
                    </a>
                </li>
                <li class="<?= $currentPage === 'settings' ? 'active' : '' ?>">
                    <a href="index.php?module=settings">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h3>Bonjour, <?= $_SESSION['user']['name'] ?></h3>
                <div class="user-info">
                    <div style="width: 40px; height: 40px; background: var(--fftri-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 10px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <span><?= $_SESSION['user']['role'] === 'admin' ? 'Administrateur' : 'Responsable Club' ?></span>
                </div>
            </div>
            
            <div class="content">
                <?php include $content; ?>
            </div>
        </div>
    </div>
</body>
</html>