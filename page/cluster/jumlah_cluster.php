<?php 

	if (isset($_POST['simpan'])) {

    $jumlah_cluster = $_POST['cluster'];

    for ($i=0; $i<$jumlah_cluster ; $i++) { 

      $sql = "insert into cluster values(null, '0')";
      $con->query($sql); 
    }
  

		echo "<script>window.location.href='index.php?p=cluster'</script>";
	}

 ?>



<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Jumlah Cluster</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Cluster</label>
              <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukan Kriteria" name="cluster" required>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success" name="simpan">Lanjutkan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->
