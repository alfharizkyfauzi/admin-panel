<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label>Type</label>
                <select class="form-control" name="usertype">
                  <option value="Admin">Admin</option>
                  <option value="User">User</option>
                </select>
            </div>
            <!-- <input type="hidden" name="usertype" value="admin"> -->
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="save_admin_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">User Profile 
    <form action="code.php" method="POST" class="float-right" style="margin-bottom: -20px;">
            <button type="submit" name="delete_user_checked" class="btn btn-danger"  data-toggle="modal" data-target="#addpost">
                <i class="fa fa-trash">&nbsp;</i> Delete Check
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addadminprofile">
            <i class="fa fa-plus">&nbsp;</i> Add User
            </button>
    </form>
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
      $query = "SELECT * FROM user_admin";
      $query_run = mysqli_query($connection, $query);
    ?>
<!-- table-bordered -->
      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Username</th>
            <th>Email </th>
            <th>Password</th>
            <th>Type</th>
            <th>Action </th>
          </tr>
        </thead>
        <tbody>

      <?php
        if(mysqli_num_rows($query_run) > 0){
          while($row = mysqli_fetch_assoc($query_run)){
            ?>

          <tr>
          <td><input type="checkbox" onclick="toogleCheckbox(this)" value="<?php echo $row['id']; ?>" <?php echo $row['visible'] == 1 ? "checked" : "" ?>></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['usertype']; ?></td>
            <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <form action="admin_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-warning"> <i class="fas fa-pencil-alt">&nbsp;</i> Edit </button>
                </form> &nbsp;
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_admin_btn" class="btn btn-danger"> <i class="fa fa-trash">&nbsp;</i> Delete </button>
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
    ?>

<script>
    function toogleCheckbox(box){
        var id = $(box).attr("value");

        if($(box).prop("checked") == true){
            var visible = 1;
        } else {
            var visible = 0;
        }
        var data = {
            "search_user_data"   : 1,
            "id"            :id,
            "visible"       : visible
        };
        $.ajax({
            type    : "post",
            url     : "code.php",
            data    : data,
            success: function(response){
                // alert("Data Checked");
            }
        });
    }
</script>

    <?php
    include('includes/footer.php');
?>