<?php
include_once'db/connect_db.php';
session_start();
if($_SESSION['role']!=="Admin"){
header('location:index.php');
}
include_once'inc/header_all.php';

if(isset($_POST['submit'])){
    $client = $_POST['client'];
    if(isset($_POST['client'])){

            $select = $pdo->prepare("SELECT client_name FROM client WHERE client_name='$client'");
            $select->execute();

            if($select->rowCount() > 0 ){
                echo'<script type="text/javascript">
                    jQuery(function validation(){
                    swal("Warning", "Client Name Exists", "warning", {
                    button: "Continue",
                        });
                    });
                    </script>';
                }else{
                    $insert = $pdo->prepare("INSERT INTO client(client_name) VALUES(:client)");

                    $insert->bindParam(':client', $client);

                    if($insert->execute()){
                        echo '<script type="text/javascript">
                        jQuery(function validation(){
                        swal("Success", "Client Added Successfully", "success", {
                        button: "Continue",
                            });
                        });
                        </script>';
                        }
                }
    }
}

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Client  
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
       <!-- Category Form-->
      <div class="col-md-4">
            <div class="box box-success">
                <!-- /.box-header -->
                <!-- form start -->
                <form action="" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="category">Client Name</label>
                      <input type="text" class="form-control" name="client" placeholder="Enter Client Name">
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </div>
                </form>
            </div>
      </div>
        <!-- Category Table -->
      <div class="col-md-8">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Client List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow-x:auto;">
            <table class="table table-striped" id="mySatuan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Client Name</th>
                        <th>Actions</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                $no = 1;
                $select = $pdo->prepare('SELECT * FROM client');
                $select->execute();
                while($row=$select->fetch(PDO::FETCH_OBJ)){ ?>
                  <tr>
                    <td><?php echo $no ++ ?></td>
                    <td><?php echo $row->client_name; ?></td>
                    <td>
                        <a href="edit_client.php?id=<?php echo $row->client_id; ?>"
                        class="btn btn-info btn-sm" name="btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="delete_client.php?id=<?php echo $row->client_id; ?>"
                        onclick="return confirm('Delete Client?')"
                        class="btn btn-danger btn-sm" name="btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
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

  <!-- DataTables Function -->
  <script>
  $(document).ready( function () {
      $('#mySatuan').DataTable();
  } );
  </script>

<?php
  include_once'inc/footer_all.php';
?>