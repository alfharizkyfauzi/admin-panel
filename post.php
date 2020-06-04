<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<div class="modal fade" id="addpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Name Title </label>
                <input type="text" name="post_title" class="form-control" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
                <label>Sub Title</label>
                <input type="text" name="post_subtitle" class="form-control" placeholder="Enter Sub Title" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="post_date" class="form-control" placeholder="" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="textarea" name="post_description" class="form-control" placeholder="Enter Descriptions" required></textarea>
            </div>
            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" name="post_image" id="post_image" class="btn btn-outline-secondary" placeholder="Enter Link" required>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" name="post_save_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">Post
        <form action="code.php" method="POST" class="float-right" style="margin-bottom: -20px;">
            <button type="submit" name="delete_post_checked" class="btn btn-danger"  data-toggle="modal" data-target="#addpost">
                <i class="fa fa-trash">&nbsp;</i> Delete Check
            </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addpost">
                <i class="fa fa-plus">&nbsp;</i> Add Post
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
      $query = "SELECT * FROM post";
      $query_run = mysqli_query($connection, $query);
    ?>
<!-- table-bordered -->
      <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Date</th>
            <th>Description</th>
            <th>Image</th>
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
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['subtitle']; ?></td>
            <td><?php $date = $row['date'];
                      echo date("D, d F Y", strtotime($date));?></td>
            <td><?php echo $row['descrip']; ?></td>
            <td><?php echo '<img src="upload/'.$row['images'].'" width="100px;" height="100px;" alt="image">' ?></td>
            <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <form action="post_edit.php" method="post">
                  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="edit_btn" class="btn btn-warning"> <i class="fas fa-pencil-alt">&nbsp;</i> Edit </button>
                </form> &nbsp;
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_post_btn" class="btn btn-danger"> <i class="fa fa-trash">&nbsp;</i> Delete </button>
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
            "search_data"   : 1,
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