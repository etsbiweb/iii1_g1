<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edukacija prve pomoći</title>
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

    .navbar-nav {
      margin: auto;
    }

    .navbar-brand img {
      height: 50px;
    }

    .navbar-nav .nav-link {
      color: #333;
    }

    .navbar-nav .nav-link:hover {
      color: rgb(179, 0, 9);
    }

    .content-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 50px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      margin: 50px auto;
      max-width: 1200px;
    }

    .left-image {
      flex: 1;
      min-height: 300px;
      background-color: #ddd;
      margin-right: 30px;
      border-radius: 10px;
    }

    .right-text {
      flex: 1;
      text-align: right;
    }

    .right-text h2 {
      color: #b30000;
      font-weight: bold;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="../index.php"><img src="../img/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="../index.php">Početna</a></li>
        <li class="nav-item"><a class="nav-link" href="#">O nama</a></li>
        <li class="nav-item"><a class="nav-link" href="../prikazdonacija.php">Donacije</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Aktivnosti</a></li>
      </ul>
      <div class="d-flex ms-auto">
        <a href="../volonter.php"><button class="btn btn-danger" type="button">Volontiraj</button></a>
      </div>
    </div>
  </div>
</nav>

<div class="content-section">
  <div class="left-image">
    <img src="../img/edukacija.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="Edukacija prve pomoći">
  </div>
  <div class="right-text">
    <h2>Najnovije vijesti o edukaciji prve pomoći</h2>
    <p>Crveni križ kontinuirano organizuje edukacije prve pomoći za građane svih uzrasta. Naši instruktori pružaju najnovije informacije i praktične vježbe kako bi svi bili spremni reagovati u hitnim situacijama.</p>
    <p>Pratite naše aktivnosti i pridružite se narednim radionicama kako biste stekli neophodna znanja i vještine koje mogu spasiti živote.</p>
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
      <div style="flex: 1; min-width: 250px; font-size: 15px;">
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
          <a href="../index.php" style="color: white; text-decoration: none;">Početna</a>
          <span>|</span>
          <a href="#" style="color: white; text-decoration: none;">O nama</a>
          <span>|</span>
          <a href="../prikazdonacija.php" style="color: white; text-decoration: none;">Donacije</a>
          <span>|</span>
          <a href="#" style="color: white; text-decoration: none;">Aktivnosti</a>
        </div>
        <div style="margin-top: 10px;">
          <a href="../admin/adminlogin.php">
            <button style="padding: 8px 16px; background-color: white; color: #b30000; border: none; border-radius: 5px;">Admin</button>
          </a>
        </div>
      </div>

      <div style="min-width: 250px; font-size: 15px;">
        <p>Crveni križ Federacije Bosne i Hercegovine</p>
        <p>@ckfbih</p>
        <p>+387 37 255 695</p>
        <p>info@ckfbih.ba</p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
