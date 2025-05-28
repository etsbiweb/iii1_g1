<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crveni križ Federacije Bosne i Hercegovine</title>
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
            color:rgb(179, 0, 9);
        }

        .news-box {
            background-image: url('img/ddk.jpg'); /* Zamijeni s stvarnom putanjom do slike */
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .news-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Zacrnjenje slike */
            z-index: 1;
        }

        .news-content {
            color: white;
            text-align: center;
            z-index: 2;
        }

        .news-content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .news-content .btn {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">O nama</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="prikazdonacija.php">Donacije</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Aktivnosti</a>
        </li>
    
      </ul>

      <div class="d-flex ms-auto">

        <a href="volonter.php"><button class="btn btn-danger" type="button">Volontiraj</button></a>

      </div>
    </div>
  </div>
</nav>

<div class="news-box">
  <div class="news-content">
    <h2><strong>Daruj krv, spasi život!</strong></h2>
    <h3>Pridruži se akciji dobrovoljnog darivanja krvi</h3>
    <a href="noviddk.php"><button class="btn btn-danger">Nova donacija</button></a>
    <a href="stariddk.php"><button class="btn btn-danger">Stalni darivaoc</button></a>

  </div>
</div>
<div class="container my-5">
  <h2 class="text-center mb-4">Najnovije vijesti</h2>
  <div class="row justify-content-center">
    <div class="col-md-4 d-flex">
      <div class="card flex-fill text-center">
        <div class="card-body">
          <h5 class="card-title">Humanitarna akcija</h5>
          <p class="card-text">Crveni križ organizuje humanitarnu akciju za pomoć ugroženima. Pridružite se!</p>
          <a href="novosti/news1.php" class="btn btn-danger">Pročitaj više</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill text-center">
        <div class="card-body">
          <h5 class="card-title">Edukacija prve pomoći</h5>
          <p class="card-text">Započele su prijave za Edukaciju vozača u pružanju prve pomoći.</p>
          <a href="novosti/news2.php" class="btn btn-danger">Pročitaj više</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 d-flex">
      <div class="card flex-fill text-center">
        <div class="card-body">
          <h5 class="card-title">Dobrovoljno darivanje krvi</h5>
          <p class="card-text">U Elektrotehničkoj srednjoj školi se sprovodi akcija dobrovoljnog darivanja krvi i animiranja punoljetnih srednjoškolaca.</p>
          <a href="novosti/news3.php" class="btn btn-danger">Pročitaj više</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Gallery Section Start -->
<div class="container my-5">
  <h2 class="text-center mb-4" style="font-family: 'Montserrat', sans-serif;">Naše ekipe</h2>
  <div class="position-relative">
    <button id="scrollLeftBtn" class="btn btn-danger position-absolute top-50 start-0 translate-middle-y" style="z-index: 10; width: 40px; height: 40px; border-radius: 50%;">&#8249;</button>
    <button id="scrollRightBtn" class="btn btn-danger position-absolute top-50 end-0 translate-middle-y" style="z-index: 10; width: 40px; height: 40px; border-radius: 50%;">&#8250;</button>
    <div id="galleryContainer" class="d-flex overflow-hidden gap-3 pb-3" style="scrollbar-width: thin; scrollbar-color: #b30000 transparent; scroll-behavior: smooth;">
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika1.jpg" class="card-img-top" alt="Galerija Slika 1" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika2.jpg" class="card-img-top" alt="Galerija Slika 2" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika3.jpg" class="card-img-top" alt="Galerija Slika 3" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika4.jpg" class="card-img-top" alt="Galerija Slika 4" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika5.jpg" class="card-img-top" alt="Galerija Slika 5" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika6.jpg" class="card-img-top" alt="Galerija Slika 6" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika7.jpg" class="card-img-top" alt="Galerija Slika 7" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika8.jpg" class="card-img-top" alt="Galerija Slika 8" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
      <div class="card border-0 shadow-sm flex-shrink-0" style="width: 300px; height: 300px;">
        <img src="img/slika9.jpg" class="card-img-top" alt="Galerija Slika 9" style="object-fit: cover; height: 100%; width: 100%;">
      </div>
    </div>
  </div>
</div>
<!-- Gallery Section End -->

<script>
  const galleryContainer = document.getElementById('galleryContainer');
  const scrollLeftBtn = document.getElementById('scrollLeftBtn');
  const scrollRightBtn = document.getElementById('scrollRightBtn');

  // Improved scrolling effect with easing
  function smoothScrollBy(element, distance, duration) {
    const start = element.scrollLeft;
    const startTime = performance.now();

    function scroll() {
      const now = performance.now();
      const time = Math.min(1, (now - startTime) / duration);
      const timeFunction = time * (2 - time); // easeOutQuad
      element.scrollLeft = start + distance * timeFunction;
      if (time < 1) {
        requestAnimationFrame(scroll);
      }
    }
    scroll();
  }

  scrollLeftBtn.addEventListener('click', () => {
    smoothScrollBy(galleryContainer, -600, 300);
  });

  scrollRightBtn.addEventListener('click', () => {
    smoothScrollBy(galleryContainer, 600, 300);
  });
</script>

<!-- Added more photos -->

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
    <!-- Lijeva strana -->
<!-- Lijeva strana -->
<div style="flex: 1; min-width: 250px; font-size: 15px;">
  <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    <a href="#" style="color: white; text-decoration: none;">Početna</a>
    <span style="color: white;">|</span>
    <a href="#" style="color: white; text-decoration: none;">O nama</a>
    <span style="color: white;">|</span>
    <a href="prikazdonacija.php" style="color: white; text-decoration: none;">Donacije</a>
    <span style="color: white;">|</span>
    <a href="#" style="color: white; text-decoration: none;">Aktivnosti</a>
  </div>
  <div style="margin-top: 10px;">
    <a href="admin/adminlogin.php">
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
