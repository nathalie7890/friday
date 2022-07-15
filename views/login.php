<?php
function get_content() {
    require_once '../controllers/connection.php';
?>
<style>
   <?php require_once '../assets/login.css'?>
</style>

<div class="container login d-flex flex-column justify-content-center">
    <div class="row">
        <div class="col-md-6 mx-auto py-5">
            <form method="POST" action="/controllers/users/login.php">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control ">
                </div>
                <div class="text-start mt-5">

                    <button class="btn btn-dark border-2 border-secondary rounded-pill px-5">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}
require_once 'layout.php';
?>