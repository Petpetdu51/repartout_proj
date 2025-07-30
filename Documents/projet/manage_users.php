<?php
session_start();
// Bloquer l'accès si l'utilisateur n'est pas connecté ou n'est pas admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php'); // Ou login.php si tu veux forcer la connexion
    exit;
}

require 'config.php';

// Vérification admin (adapter selon ta config)
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: login.php');
    exit;
}

// Gestion création utilisateur (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute(['username' => $username, 'password' => $hashed_password]);
            $message = "Utilisateur créé avec succès.";
        } catch (PDOException $e) {
            $message = "Erreur lors de la création : " . $e->getMessage();
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

// Gestion des actions (activation, suppression, toggle)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] === 'delete') {
        // Empêcher suppression admin (optionnel)
        $stmtCheck = $pdo->prepare("SELECT is_admin FROM users WHERE id = :id");
        $stmtCheck->execute(['id' => $id]);
        $userCheck = $stmtCheck->fetch();
        if ($userCheck && $userCheck['is_admin'] == 0) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $message = "Utilisateur supprimé.";
        } else {
            $message = "Impossible de supprimer un administrateur.";
        }
    } elseif ($_GET['action'] === 'activate') {
        $stmt = $pdo->prepare("UPDATE users SET is_active = 1 WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $message = "Utilisateur activé.";
    } elseif ($_GET['action'] === 'toggle_active') {
        $stmt = $pdo->prepare("SELECT is_active FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        if ($user) {
            $newState = $user['is_active'] ? 0 : 1;
            $stmt = $pdo->prepare("UPDATE users SET is_active = :newState WHERE id = :id");
            $stmt->execute(['newState' => $newState, 'id' => $id]);
            $message = $newState ? "Utilisateur activé." : "Utilisateur désactivé.";
        }
    }
    // Redirection pour éviter resoumission
    header('Location: manage_users.php');
    exit;
}

// Récupérer les utilisateurs en attente d'activation
$stmt = $pdo->query("SELECT id, username FROM users WHERE is_active = 0 ORDER BY id ASC");
$pendingUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT id, username, is_admin, is_active FROM users ORDER BY id ASC");
$allUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        a.action-btn {
            padding: 6px 12px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 0 4px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        a.action-btn:hover {
            background-color: #1f618d;
        }
        .btn-danger {
            background-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .btn-success {
            background-color: #27ae60;
        }
        .btn-success:hover {
            background-color: #1e8449;
        }
        .message {
            color: green;
            margin: 15px 0;
        }
        .error {
            color: red;
        }
        form.inline {
            display: inline;
        }
    </style>
</head>
<body>
    <h1>Gestion des utilisateurs</h1>

    <?php if (isset($message)): ?>
        <p class="<?= strpos($message, 'Erreur') === 0 ? 'error' : 'message' ?>"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <section>
        <h2>Créer un nouvel utilisateur</h2>
        <form action="manage_users.php" method="POST" autocomplete="off">
            <input type="hidden" name="action" value="create">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Créer</button>
        </form>
    </section>

    <section>
        <h2>Demandes d'inscription en attente</h2>
        <?php if (count($pendingUsers) === 0): ?>
            <p>Aucune demande d'inscription en attente.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingUsers as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td>
                                <a href="manage_users.php?action=activate&id=<?= $user['id'] ?>" class="action-btn btn-success">Valider</a>
                                <a href="manage_users.php?action=delete&id=<?= $user['id'] ?>" class="action-btn btn-danger" onclick="return confirm('Refuser et supprimer cette demande ?')">Refuser</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

    <section>
        <h2>Tous les utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Admin</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= $user['is_admin'] ? 'Oui' : 'Non' ?></td>
                        <td><?= $user['is_active'] ? 'Oui' : 'Non' ?></td>
                        <td>
                            <a href="manage_users.php?action=toggle_active&id=<?= $user['id'] ?>" class="action-btn">
                                <?= $user['is_active'] ? 'Désactiver' : 'Activer' ?>
                            </a>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="action-btn">Modifier</a>
                            <?php if ($user['is_admin'] == 0): ?>
                                <a href="manage_users.php?action=delete&id=<?= $user['id'] ?>" class="action-btn btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <p><a href="index.php">Retour à l'accueil</a> | <a href="logout.php">Se déconnecter</a></p>
</body>
</html>

