
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
    .btn:hover {
        border: none;
    }
</style>
<?php if(isset($_SESSION['user_info'])): ?>
<input type="hidden" id="user_id" value="<?php echo $_SESSION['user_info']['id']?>">
<?php endif; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-* mx-auto pt-3">
  <div class="container-fluid">
    <a class="navbar-brand ms-5 text-info fs-5 fw-bolder" href="/">Friday</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav gap-2 me-auto mb-2 mb-lg-0">
        <a class="nav-link active" aria-current="page" href="/">Home</a>
        <?php if(isset($_SESSION['user_info'])): ?>
          <a class="nav-link text-white" href="../views/profile.php">Profile</a>
        <a class="nav-link text-white" href="../views/match2.php">Explore</a>
        <a class="nav-link text-white position-relative border-0 matchNav" href="../../controllers/users/accept.php?id=<?php echo $_SESSION['user_info']['id']?>">
          Match
          <span class="position-absolute top-25 start-100 translate-middle p-1 bg-info rounded-circle match d-none"></span>
        </a>
        <a class="nav-link text-white position-relative border-0 chatNav" href="../../controllers/views/message.php">
          Chat
          <span class="position-absolute top-25 start-100 translate-middle p-1 bg-info rounded-circle chatt d-none"></span>
        </a>
        <?php endif; ?>
      </div>
      <div class="d-flex me-5">
        <?php if(isset($_SESSION['user_info'])): ?>
        <a class="nav-link text-info me-3 text-info fw-bolder" href="#"><?php echo $_SESSION['user_info']['firstname'] . " " . $_SESSION['user_info']['lastname']?></a>
        <a class="nav-link text-white" href="../../controllers/users/logout.php">Logout</a>
        
        <?php else: ?>
          <a class="nav-link text-white" href="../views/login.php">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<script>

    $(document).ready(function(){
      setInterval(() => {
        $.ajax({
          method: "post",
          url: '../controllers/users/notification.php',
          data: '',
          success: function(response) {
            if(response == 1) {
              $('.match').removeClass('d-none');
            } else if(response == 2) {
              $('.chatt').removeClass('d-none');
              $('.match').addClass('d-none');
            } else if(response == 3) {
              $('.match').removeClass('d-none');
              $('.chatt').removeClass('d-none');
            } 
          }
        })
      }, 1000);
    });

    $('.matchNav').click(function(e) {
      e.preventDefault();
      $.ajax({
          method: "post",
          url: '../../controllers/users/match_noti.php',
          data: {
            id: $('#user_id').val()
          },
          success: function(response) {
          }
        })
        window.location.href = "../../views/success.php";
    })

    $('.chatNav').click(function(e) {
      e.preventDefault();
      $.ajax({
          method: "post",
          url: '../../controllers/users/chat_noti.php',
          data: {
            id: $('#user_id').val()
          },
          success: function(response) {
          }
        })
        window.location.href = "../../views/message.php";
    })
</script>
  
