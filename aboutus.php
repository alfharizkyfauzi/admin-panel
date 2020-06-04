<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<div class="modal fade" id="addaboutus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Title </label>
                <input type="text" name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label>Sub Title</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Enter Sub Title">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Enter Descriptions"></textarea>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" name="links" class="form-control" placeholder="Enter Link">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="about_save_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">About Us 
            <button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#addaboutus">
            <i class="fa fa-plus">&nbsp;</i> Add Text
            </button>
    </h2>
  </div>

  <div class="card-body">

    <?php 
      if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
        echo '<h6 class="alert alert-success" role="alert"> ' .$_SESSION['success'].' <h6>'; 
        unset($_SESSION['success']);
      } 
      if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
        echo '<h6 class="alert alert-danger" role="alert"> ' .$_SESSION['status'].' <h6>'; 
        unset($_SESSION['status']);
      }
    ?>

    <div class="table-responsive">

    <?php 
    $connection = mysqli_connect("localhost","root","","adminpanel");
      $query = "SELECT * FROM abouts";
      $query_run = mysqli_query($connection, $query);
    ?>
<!-- table-bordered -->
      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Subtitle </th>
            <th>Description</th>
            <th>Links</th>
            <th>Action </th>
          </tr>
        </thead>
        <tbody>

      <?php
        if(mysqli_num_rows($query_run) > 0){
          while($row = mysqli_fetch_assoc($query_run)){
            ?>

          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['subtitle']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['links']; ?></td>
            <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <form action="about_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-warning"> <i class="fas fa-pencil-alt">&nbsp;</i> Edit </button>
                </form> &nbsp;
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_about_btn" class="btn btn-danger"> <i class="fa fa-trash">&nbsp;</i> Delete </button>
                </form>
            </div>
            </td>
          </tr>

          <?php
          }
        } else {
          echo "No Record Found"; 
        }
      ?>

        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>