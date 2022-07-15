

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-* mx-auto fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-5" href="/">Friday</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav  me-auto mb-2 mb-lg-0">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
        <?php if(isset($_SESSION['user_info'])): ?>
        <a class="nav-link" href="../views/match2.php">Explore</a>
        <a class="nav-link" href="../views/profile.php">Profile</a>
        <a class="nav-link" href="../views/success.php">Match</a>
        <?php endif; ?>
      </div>
      <div class="d-flex me-5">
        <?php if(isset($_SESSION['user_info'])): ?>
        <a class="nav-link text-info me-3" href="#"><?php echo $_SESSION['user_info']['firstname']?></a>
        <a class="nav-link text-secondary" href="../../controllers/users/logout.php">Logout</a>
        
        <?php else: ?>
          <a class="nav-link text-secondary" href="../views/login.php">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>



  



  