<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FFTRI - Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --fftri-blue: #0033A0;
            --fftri-red: #D50032;
            --white: #FFFFFF;
            --light-gray: #F6F6F6;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
        }
        
        .login-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 51, 160, 0.8), rgba(0, 51, 160, 0.9));
            align-items: center;
            justify-content: center;
        }
        
        .login-box {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-logo h1 {
            color: var(--fftri-blue);
            margin-top: 15px;
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
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--fftri-blue);
            outline: none;
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background-color: var(--fftri-blue);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .btn:hover {
            background-color: #00257a;
        }
        
        .error {
            color: var(--fftri-red);
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: rgba(213, 0, 50, 0.1);
            border-radius: 4px;
        }
        
        .demo-info {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: rgba(0, 51, 160, 0.1);
            border-radius: 4px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <div style="width: 120px; height: 60px; background: var(--fftri-blue); margin: 0 auto; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">LOGO FFTRI</div>
                <h1>Gestion des Triathlons</h1>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST" action="index.php?action=authenticate">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required value="admin@fftri.com">
                </div>
                
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" required value="password">
                </div>
                
                <button type="submit" class="btn">Se connecter</button>
            </form>
            
            <div class="demo-info">
                <strong>Compte de démonstration :</strong><br>
                Email: admin@fftri.com<br>
                Mot de passe: password
            </div>
        </div>
    </div>
</body>
</html>