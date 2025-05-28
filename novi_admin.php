<?php
session_start();
include '../includes/db.inc.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

function posaljiEmailZahtjev($korisnicko_ime, $lozinka, $id_admina) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'medinaalagic2007@gmail.com'; 
        $mail->Password = 'pcxo jeri nbdm klpl'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('TVOJEMAIL@gmail.com', 'Red Cross Sistem');
        $mail->addAddress('medinaalagic2007@gmail.com'); 

        // Sadržaj
        $mail->isHTML(true);
        $mail->Subject = 'Zahtjev za novog administratora';
        $mail->Body = "
            Novi zahtjev za administratorski pristup:<br><br>
            Korisničko ime: <strong>$korisnicko_ime</strong><br>
            Lozinka: <strong>$lozinka</strong><br><br>
            Kliknite na dugme ispod da odobrite ovog korisnika kao administratora:<br>
            <a href='http://localhost/redcrossprojekat/admin/novi_admin.php?action=odobri&id=$id_admina'>
                <button style='padding: 10px 20px; background-color: green; color: white; border: none; cursor: pointer;'>Dodaj kao Administratora</button>
            </a><br><br>
            Ručno dodaj ovog korisnika u bazu ako želiš da postane admin.
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $hashed_lozinka = password_hash($lozinka, PASSWORD_DEFAULT);

    $sql = "INSERT INTO privremeni_admini (korisnicko_ime, lozinka) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$korisnicko_ime, $hashed_lozinka]);

    $id_admina = $pdo->lastInsertId();
    posaljiEmailZahtjev($korisnicko_ime, $lozinka, $id_admina);

    $poruka = "Na čekanju ste. Čeka se odobrenje administratora.";
}

if (isset($_GET['action']) && $_GET['action'] == 'odobri' && isset($_GET['id'])) {
    $id_admina = $_GET['id'];

    $sql = "SELECT * FROM privremeni_admini WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_admina]);
    $admin = $stmt->fetch();

    if ($admin) {
        $sql = "INSERT INTO administratori (korisnicko_ime, lozinka) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$admin['korisnicko_ime'], $admin['lozinka']]);

        $sql = "DELETE FROM privremeni_admini WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_admina]);

        $poruka = "Administrator je uspješno dodan!";
    } else {
        $poruka = "Nema zahtjeva za administratora s ovim ID-om.";
    }
}
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zahtjev za novog administratora | Crveni križ FBiH</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .navbar {
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            padding: 15px 0;
            transition: background-color 0.3s ease;
        }
        .navbar.scrolled {
            background-color: rgba(211, 211, 211, 0.9);
        }
        .navbar-nav .nav-link {
            color: #333;
        }
        .navbar-nav .nav-link:hover {
            color: rgb(179, 0, 9);
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="../img/logo.png" alt="Logo" height="50"></a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="../index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">O nama</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../prikazdonacija.php">Donacije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Aktivnosti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Zahtjev za novog administratora</h2>

        <form method="POST" action="novi_admin.php">
            <div class="mb-3">
                <label for="korisnicko_ime" class="form-label">Korisničko ime</label>
                <input type="text" id="korisnicko_ime" name="korisnicko_ime" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="lozinka" class="form-label">Lozinka</label>
                <input type="password" id="lozinka" name="lozinka" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Pošaljite zahtjev</button>
        </form>
    </div>

    <?php if (isset($poruka)): ?>
        <div class="alert alert-info mt-4">
            <?php echo htmlspecialchars($poruka); ?>
        </div>
    <?php endif; ?>
</div>

<script>
  window.onscroll = function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 10) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
  };
</script>

</body>
</html>
