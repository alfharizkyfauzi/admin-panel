<?php 
    session_start();
    include('includes/header.php'); 
?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 50px;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    
                    <?php
                        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                            echo '<h6 class="alert alert-danger" role="alert"> ' .$_SESSION['status'].' <h6>'; 
                            unset($_SESSION['status']);
                        }
                    ?>
                  </div>
                  <form class="user" action="logincode.php" method="POST">
                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user"  placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user"  placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                    <div class="text-center">
                      <h7 class="h7 text-gray-600 mb-4" style="font-size: 13px;">Copyright &copy; by <a style="text-decoration:none;" href="https://www.linkedin.com/in/alfharizky-fauzi-20628817b"> Alfharizky Fauzi </a><?php echo date('Y')?></h7>
                    </div>
                  </form>
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>

</div>


<?php
    include('includes/scripts.php');
?>

