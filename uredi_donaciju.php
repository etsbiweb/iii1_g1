<?php
// PDO connection
$host = 'localhost';
$db   = 'redcross';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Greška u konekciji: " . $e->getMessage());
}

// Check if id is provided
if (!isset($_GET['id'])) {
    die("ID donacije nije specificiran.");
}

$id = (int)$_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datum = $_POST['datum_donacije'] ?? '';
    $vrijeme = $_POST['vrijeme_donacije'] ?? '';

    if (empty($datum) || empty($vrijeme)) {
        $error = "Sva polja su obavezna.";
    } else {
        $stmt = $pdo->prepare("UPDATE donacije SET datum_donacije = ?, vrijeme_donacije = ? WHERE id = ?");
        $stmt->execute([$datum, $vrijeme, $id]);
        header("Location: admin.php");
        exit;
    }
}

// Fetch current donation data
$stmt = $pdo->prepare("SELECT * FROM donacije WHERE id = ?");
$stmt->execute([$id]);
$donacija = $stmt->fetch();

if (!$donacija) {
    die("Donacija nije pronađena.");
}
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <title>Uredi donaciju</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(128, 0, 0, 0.2);
            border-top: 6px solid #dc3545;
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #dc3545;
        }

        input, button, a.btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        input[type="submit"],
        button {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #a30000;
        }

        a.btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        a.btn-secondary:hover {
            background-color: #565e64;
        }

        .alert {
            margin-bottom: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Uredi donaciju ID: <?= htmlspecialchars($id) ?></h2>
    <?php if (!empty($error)): ?>
        <div class="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="datum_donacije">Datum donacije</label>
        <input type="date" id="datum_donacije" name="datum_donacije" value="<?= htmlspecialchars($donacija['datum_donacije']) ?>" required>

        <label for="vrijeme_donacije">Vrijeme donacije</label>
        <input type="time" id="vrijeme_donacije" name="vrijeme_donacije" value="<?= htmlspecialchars($donacija['vrijeme_donacije']) ?>" required>

        <button type="submit">Sačuvaj promjene</button>
        <a href="admin.php" class="btn btn-secondary">Odustani</a>
    </form>
</div>
</body>
</html>