<?php 
    include('security.php');
    include('includes/header.php'); 
    include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h2 class="m-0 font-weight-bold text-primary">Edit Post </h2>
  </div>

  <div class="card-body">
      <?php
    $connection = mysqli_connect("localhost","root","","adminpanel");
      if(isset($_POST['edit_btn'])){
        $id = $_POST['edit_id'];
        
        $query = "SELECT * FROM post WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);

        foreach($query_run as $row){
            ?>
            
    <form action="code.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
            <div class="form-group">
                <label> Title </label>
                <input type="text" name="edit_title" value="<?php echo $row['title'];?>" class="form-control" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label>Subtitle</label>
                <input type="text" name="edit_subtitle" value="<?php echo $row['subtitle'];?>" class="form-control" placeholder="Enter subtitle">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="edit_date" value="<?php echo $row['date'];?>" class="form-control" placeholder="Enter subtitle">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="edit_description"  class="form-control" placeholder="Enter description"><?php echo $row['descrip'];?></textarea>
            </div>
            <div class="form-group">
                <label>Update Images</label>
                <input type="file" name="post_image" id="post_image" value="<?php echo $row['image'];?>" class="" placeholder="Enter links">
            </div>
        <div class="modal-footer">
            <a href="post.php" class="btn btn-danger" data-dismiss="modal">Cancel</a>
            <button type="submit" name="update_post_btn" class="btn btn-primary">Update</button>
        </div>
    </form>
        <?php
        }
    }
      ?> 
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
    include('includes/scripts.php');
    include('includes/footer.php');
?>