<?php
session_start();
include 'includes/db.inc.php'; 
include 'includes/zadnjaDonacija.inc.php';

if (!isset($_SESSION['admin_id'])) {
    echo "<p style='color:red; text-align:center; margin-top:20px;'>Niste prijavljeni kao admin. Molimo da se prijavite kako biste pristupili ovoj stranici.</p>";
    exit;
}

$admin_id = $_SESSION['admin_id'];
$ime = $_SESSION['admin_ime'] ?? 'Admin';

$admin_id = $_SESSION['admin_id'];
$ime = $_SESSION['admin_ime'] ?? 'Admin';

// Ucitavanje prijava korisnika


// Ucitavanje nadolazecih termina donacija
try {
    $stmt = $pdo->query("SELECT datum_donacije, vrijeme_donacije 
                         FROM donacije 
                         ORDER BY datum_donacije ASC, vrijeme_donacije ASC");
    $donacije = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "❌ Greška pri dohvaćanju donacija: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Crveni križ FBiH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f2f2f2;
        }
        .navbar {
            position: sticky;
            top: 0;
            background-color: transparent;
            transition: background-color 0.3s ease;
        }
        .navbar.scrolled {
            background-color: rgba(211, 211, 211, 0.9);
        }
        .navbar-brand img {
            height: 50px;
        }
        .nav-link:hover {
            color: rgb(179, 0, 9);
        }
        .card {
            margin-top: 30px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Početna</a></li>
        <li class="nav-item"><a class="nav-link" href="#">O nama</a></li>
        <li class="nav-item"><a class="nav-link" href="prikazdonacija.php">Donacije</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Aktivnosti</a></li>
      </ul>
      <a href="volonter.php" class="btn btn-danger">Volontiraj</a>
    </div>
  </div>
</nav>

<div class="container d-flex justify-content-center">
  <div class="col-md-8">
    <div class="card text-center">
      <h2 class="mb-4">Nadolazeći termini darivanja</h2>

      <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#adminModal">
        Dodaj nadolazeću donaciju
      </button>

      <?php if (count($donacije) > 0): ?>
        <ul class="list-group">
            <?php foreach ($donacije as $d): ?>
                <li class="list-group-item">
                    <?= date("d.m.Y", strtotime($d['datum_donacije'])) ?> u <?= substr($d['vrijeme_donacije'], 0, 5) ?>
                </li>
            <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="mt-3">Nema trenutno zakazanih termina.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Modal za dodavanje termina -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="includes/dodaj_donaciju.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Dodaj nadolazeću donaciju</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="adminIme" class="form-label">Korisničko ime (admin)</label>
          <input type="text" class="form-control" name="adminIme" required>
        </div>
        <div class="mb-3">
          <label for="adminSifra" class="form-label">Šifra</label>
          <input type="password" class="form-control" name="adminSifra" required>
        </div>
        <div class="mb-3">
          <label for="datumDonacije" class="form-label">Datum</label>
          <input type="date" class="form-control" name="datumDonacije" required>
        </div>
        <div class="mb-3">
          <label for="vrijemeDonacije" class="form-label">Vrijeme</label>
          <input type="time" class="form-control" name="vrijemeDonacije" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Dodaj</button>
      </div>
    </form>
  </div>
</div>

<script>
  window.onscroll = function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('scrolled', window.scrollY > 10);
  };
</script>

</body>
</html>
