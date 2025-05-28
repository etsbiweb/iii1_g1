<?php
// PDO konekcija
$host = 'localhost';
$db   = 'redcross';
$user = 'root';
$pass = ''; // Promijeni ako koristiš lozinku
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

// Upiti
$donacije = $pdo->query("SELECT d.id, d.datum_donacije, d.vrijeme_donacije, a.korisnicko_ime 
                         FROM donacije d JOIN administratori a ON d.admin_id = a.id");

$korisnici = $pdo->query("SELECT * FROM prijave");

$admini = $pdo->query("SELECT * FROM administratori");
?>

<!DOCTYPE html>
<html lang="bs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel | Crveni križ FBiH</title>
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
            padding: 15px 0;
            transition: background-color 0.3s ease;
        }

        .navbar.scrolled {
            background-color: rgba(211, 211, 211, 0.9);
        }

        .navbar-brand img {
            height: 50px;
        }

        .navbar-nav .nav-link {
            color: #333;
        }

        .navbar-nav .nav-link:hover {
            color:rgb(179, 0, 9);
        }

        section {
            background-color: #f8f8f8;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 8px solid #b30000;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        h2 {
            color: #b30000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #ddd;
        }

        .btn-sm {
            margin-right: 5px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../img/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link active" href="../index.php">Početna</a></li>
        <li class="nav-item"><a class="nav-link" href="#">O nama</a></li>
        <li class="nav-item"><a class="nav-link" href="../prikazdonacija.php">Donacije</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Aktivnosti</a></li>
      </ul>
      <div class="d-flex ms-auto">
        <a href="volonter.php"><button class="btn btn-danger" type="button">Volontiraj</button></a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-4">

  <section>
      <div class="section-header">
        <h2>Prijavljene donacije</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adminModal">Dodaj nadolazeću donaciju</button>
      </div>
      <table>
          <tr>
              <th>ID</th>
              <th>Datum</th>
              <th>Vrijeme</th>
              <th>Admin</th>
              <th>Akcije</th>
          </tr>
          <?php foreach ($donacije as $row): ?>
          <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['datum_donacije']) ?></td>
              <td><?= htmlspecialchars($row['vrijeme_donacije']) ?></td>
              <td><?= htmlspecialchars($row['korisnicko_ime']) ?></td>
              <td>
                  <a href="uredi_donaciju.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Uredi</a>
                  <a href="obrisi_donaciju.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Jeste li sigurni da želite obrisati ovu donaciju?')">Obriši</a>
              </td>
          </tr>
          <?php endforeach; ?>
      </table>
  </section>

  <section>
      <h2>Prijavljeni korisnici</h2>
      <table>
          <tr>
              <th>ID</th>
              <th>Ime i prezime</th>
              <th>JMBG</th>
              <th>Datum rođenja</th>
              <th>Spol</th>
              <th>Krvna grupa</th>
              <th>Kontakt</th>
              <th>Email</th>
              <th>Mjesto</th>
          </tr>
          <?php foreach ($korisnici as $row): ?>
          <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['ime_prezime']) ?></td>
              <td><?= htmlspecialchars($row['jmbg']) ?></td>
              <td><?= htmlspecialchars($row['datum_rodjenja']) ?></td>
              <td><?= htmlspecialchars($row['spol']) ?></td>
              <td><?= htmlspecialchars($row['krvna_grupa']) ?></td>
              <td><?= htmlspecialchars($row['kontakt']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['mjesto']) ?></td>
          </tr>
          <?php endforeach; ?>
      </table>
  </section>

  <section>
      <div class="section-header">
        <h2>Prijavljeni admini</h2>
        <a href="admin/novi_admin.php" class="btn btn-success btn-sm">+ Dodaj</a>
      </div>
      <table>
          <tr>
              <th>ID</th>
              <th>Korisničko ime</th>
          </tr>
          <?php foreach ($admini as $row): ?>
          <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['korisnicko_ime']) ?></td>
              
          </tr>
          <?php endforeach; ?>
      </table>
  </section>

</div>
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title mb-3" id="adminModalLabel">Dodaj nadolazeću donaciju</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="admin/dodajdonacijuAdmin.php" method="POST">
                <div class="mb-3">
                  <label for="adminIme" class="form-label">Korisničko ime</label>
                  <input type="text" class="form-control" id="adminIme" name="adminIme" required>
                </div>
                <div class="mb-3">
                  <label for="adminSifra" class="form-label">Šifra</label>
                  <input type="password" class="form-control" id="adminSifra" name="adminSifra" required>
                </div>
                <div class="mb-3">
                  <label for="datumDonacije" class="form-label">Datum donacije</label>
                  <input type="date" class="form-control" id="datumDonacije" name="datumDonacije" required>
                </div>
                <div class="mb-3">
                  <label for="vrijemeDonacije" class="form-label">Vrijeme donacije</label>
                  <input type="time" class="form-scontrol" id="vrijemeDonacije" name="vrijemeDonacije" required>
                </div>
                <button type="submit" class="btn btn-primary" action="admin/dodajdonacijuAdmin.php">Dodaj donaciju</button>
                <div class="text-center mt-3">
                  <a href="novi_admin.php" class="btn btn-sm btn-outline-secondary">Novi admin? Prijavite se.</a>
                </div>
              </form>
            </div>
          </div>
        </div>
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

<footer style="background-color: #b30000; color: white; padding: 20px 40px;">
<div class="container"> 
<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
 <!-- Lijeva strana -->
<div style="flex: 1; min-width: 250px; font-size: 15px;">
  <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    <a href="../index.php" style="color: white; text-decoration: none;">Početna</a>
    <span style="color: white;">|</span>
    <a href="#" style="color: white; text-decoration: none;">O nama</a>
    <span style="color: white;">|</span>
    <a href="../prikazdonacija.php" style="color: white; text-decoration: none;">Donacije</a>
    <span style="color: white;">|</span>
    <a href="#" style="color: white; text-decoration: none;">Aktivnosti</a>
  </div>
  <div style="margin-top: 10px;">
    <a href="adminlogin.php">
      <button style="padding: 8px 16px; background-color: white; color: #b30000; border: none; border-radius: 5px; cursor: pointer;">Admin</button>
    </a>
  </div>
</div>


    
    
    <!-- Desna strana -->
     
    <div style=" min-width: 250px; font-size: 15px;">
      <p style="margin: 5px 0;">Crveni križ Federacije Bosne i Hercegovine</p>
      <p style="margin: 5px 0;">@ckfbih</p>
      <p style="margin: 5px 0;">+387 37 255 695</p>
      <p style="margin: 5px 0;">info@ckfbih.ba</p>
    </div>
  </div>
</footer>
  </div>
</body>
</html>
