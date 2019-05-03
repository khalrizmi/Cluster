<?php 

	if (isset($_POST['simpan'])) {


      $sql = "insert into alternatif values(null, '$_POST[nama_alternatif]')";
      $con->query($sql);
      $last_id = $con->insert_id;


	    $sql = "select * from kriteria";
      $query = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_assoc($query)){
        
        $nilai = $_POST['kriteria'.$row['id_kriteria']];
        $sql = "insert into nilai_alternatif values(null, '$last_id', '$row[id_kriteria]', '$nilai')";
        mysqli_query($con, $sql);
      }

      echo "<script>alert('Data berhasil disimpan!');window.location.href='index.php?p=alternatif'</script>";

	}

 ?>

<div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Alternatif</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Alternatif</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukan Alternatif" name="nama_alternatif" required>
            </div>
            <?php 

              $sql = "select * from kriteria";
              $query = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_assoc($query)):

                $sql2 = "select * from desc_kriteria where id_kriteria='$row[id_kriteria]'";
                $query2 = mysqli_query($con, $sql2);
                $jumlah = mysqli_num_rows($query2);
                if ($jumlah > 0){
                  ?>
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $row['kriteria'] ?></label>              
                <select class="form-control" name="kriteria<?= $row['id_kriteria'] ?>" required>
                  <?php 
                    while ($row2 = mysqli_fetch_assoc($query2)) {
                      echo "<option value='$row2[nilai]'>$row2[deskripsi]</option>";
                    }
                   ?>
                </select>
              </div>    
              <?php
                } else {
             ?>
              <div class="form-group">
                <label for="exampleInputEmail1"><?= $row['kriteria'] ?></label>              
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Masukan <?= $row['kriteria'] ?>" name="kriteria<?= $row['id_kriteria'] ?>" required>
              </div>
              <?php } ?>
            <?php endwhile; ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            <!-- <a href="index.php?p=jumlah_cluster" class="btn btn-success" style="float: right;">Lanjutkan</a> -->
          </div>
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
    
  </div>
  <!-- /.row -->