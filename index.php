<?php
function get_content() {
?>

<div class="header d-flex justify-content-center align-items-center">
    <!-- <img src="/public/header.jpg" class="header-img img-fluid"> -->
    <div  data-aos="fade-up" data-aos-duration="3000" class="text-center">
        <h1>Friday</h1>
        <h3>Find Your Match</h3>
        <?php if(!isset($_SESSION['user_info'])): ?>
        <a href="views/signup.php" class="btn btn-dark btn-lg rounded-pill px-5">Join Now</a>
        <?php endif; ?>
    </div>

</div>
<?php
}
require_once 'views/layout.php';
?>