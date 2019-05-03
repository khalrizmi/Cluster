<?php 

  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "delete from alternatif where id_alternatif='$id'";
    $query = mysqli_query($con, $sql);
    if ($query) {
      $sql = "delete from nilai_alternatif where id_alternatif='$id'";
      $con->query($sql);

      echo "<script>alert('Data berhasil dihapus!');window.location.href='index.php?p=alternatif'</script>";
    } else {
      echo mysqli_error($con);
    }
  }

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Alternatif</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              <?php   
                    $sql = "select * from kriteria";
                    $query = mysqli_query($con, $sql);
                    while ($data = mysqli_fetch_assoc($query)):
               ?>
                
                <th><?= $data['kriteria'] ?></th>
             <?php endwhile; ?>

              <th>Hapus</th>
            </tr>
            </thead>
            <tbody>
              <?php 

                $no = 0;
                $sql = "select * from alternatif";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):
                $no++;
               ?>
               <tr>
                <td><?= $no ?></td>
                <td><?= $row['nama_alternatif'] ?></td>
                
                <?php 
                    $sql2 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]'";
                    $query2 = mysqli_query($con, $sql2);
                    while($row2 = mysqli_fetch_assoc($query2)):
                ?>
                  <td><?= $row2['nilai'] ?></td>
                <?php endwhile; ?>

                <td>
                  <a href="index.php?p=alternatif&delete&id=<?= $row['id_alternatif'] ?>" class="btn btn-danger" onclick="return confirm('Jika data dihapus, maka data bobot kriteria akan direset?')"><i class="glyphicon glyphicon-trash"></i></a>
                
                </td>
               </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <a href="index.php?p=alternatif&act=create" class="btn btn-primary" style="margin-top: 10px;">Tambah Alternatif</a>

          <?php 

              $sql = "select * from alternatif";
              $query = mysqli_query($con, $sql);
              $rows = mysqli_num_rows($query);
              if ($rows > 0) :
           ?>
          <a href="index.php?p=cluster&act=jumlah" class="btn btn-success" style="margin: 10px 20px 0 0; float: right;">Lanjutkan</a>
          <?php endif; ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->