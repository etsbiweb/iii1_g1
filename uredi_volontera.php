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
    die("ID volontera nije specificiran.");
}

$id = (int)$_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = $_POST['ime'] ?? '';
    $prezime = $_POST['prezime'] ?? '';
    $datum_rodenja = $_POST['datum_rodenja'] ?? '';
    $email = $_POST['email'] ?? '';
    $broj_telefona = $_POST['broj_telefona'] ?? '';

    if (empty($ime) || empty($prezime) || empty($datum_rodenja) || empty($email) || empty($broj_telefona)) {
        $error = "Sva polja su obavezna.";
    } else {
        $stmt = $pdo->prepare("UPDATE volonter SET ime = ?, prezime = ?, datum_rodenja = ?, email = ?, broj_telefona = ? WHERE id = ?");
        $stmt->execute([$ime, $prezime, $datum_rodenja, $email, $broj_telefona, $id]);
        header("Location: admin.php");
        exit;
    }
}

// Fetch current volunteer data
$stmt = $pdo->prepare("SELECT * FROM volonter WHERE id = ?");
$stmt->execute([$id]);
$volonter = $stmt->fetch();

if (!$volonter) {
    die("Volonter nije pronađen.");
}
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Uredi volontera</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
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

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"], .btn-secondary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #dc3545;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #a30000;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background-color: #ccc;
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Uredi volontera ID: <?= htmlspecialchars($id) ?></h2>
    <?php if (!empty($error)): ?>
        <div class="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="ime">Ime</label>
        <input type="text" id="ime" name="ime" value="<?= htmlspecialchars($volonter['ime']) ?>" required>

        <label for="prezime">Prezime</label>
        <input type="text" id="prezime" name="prezime" value="<?= htmlspecialchars($volonter['prezime']) ?>" required>

        <label for="datum_rodenja">Datum rođenja</label>
        <input type="date" id="datum_rodenja" name="datum_rodenja" value="<?= htmlspecialchars($volonter['datum_rodenja']) ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($volonter['email']) ?>" required>

        <label for="broj_telefona">Broj telefona</label>
        <input type="text" id="broj_telefona" name="broj_telefona" value="<?= htmlspecialchars($volonter['broj_telefona']) ?>" required>

        <input type="submit" value="Sačuvaj promjene">
        <a href="admin.php" class="btn-secondary">Odustani</a>
    </form>
</div>
</body>
</html>