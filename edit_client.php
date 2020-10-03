<?php
  include_once'db/connect_db.php';
  session_start();
  if($_SESSION['role']!=="Admin"){
    header('location:index.php');
  }


if(isset($_POST['btn_edit'])){
      $client_name = $_POST['client'];
      $update = $pdo->prepare("UPDATE client SET client_name='$client_name' WHERE client_id='".$_GET['id']."' ");
      $update->bindParam(':client_name', $client_name);
      if($update->rowCount() > 0){
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Warning", "This client exists", "warning", {
        button: "Continue",
            });
        });
        </script>';
      }elseif($update->execute()){
        echo'<script type="text/javascript">
        jQuery(function validation(){
        swal("Success", "Client Name has been updated", "success", {
        button: "Continue",
            });
        });
        </script>';
      }
}


if($id=$_GET['id']){
    $select = $pdo->prepare("SELECT * FROM client WHERE client_id = '".$_GET['id']."' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    $client_name = $row->client_name;
}else{
    header('location:clients.php');
}


  include_once'inc/header_all.php';

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Product Category
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-4">
            <div class="box box-warning">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Client Name</label>
                      <input type="text" class="form-control" name="client" placeholder="Enter Name"
                      value="<?php echo $client_name; ?>" required>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="btn_edit">Update</button>
                      <a href="clients.php" class="btn btn-warning">Back</a>
                  </div>
                </form>
            </div>
      </div>

      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List of Clients</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Client Name</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
              $select = $pdo->prepare('SELECT * FROM client');
              $select->execute();
              while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                <tr>
                    <td><?php echo $no++    ;?></td>
                    <td><?php echo $row->client_name; ?></td>
                </tr>
              <?php
              }
              ?>

              </tbody>
          </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
    include_once'inc/footer_all.php';
?>
