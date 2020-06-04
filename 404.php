<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>
<!-- Begin Page Content -->
 <div class="container">
    <div class="row">
        <div class="col-md-6 mr-auto ml-auto text-center py-5 mt-5">
            <div class="card">
            <div class="card-body">
                <h1 class="card-title alert alert-warning"> Error Page </h1>
                <h2 class="card-title">404 Error</h2>
                <p class="card-text">The Page You are searching for is Not Available .</p>
                <a href="index.php" class="btn btn-primary">Go back to Home Page</a>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>