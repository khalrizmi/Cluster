<?php 
  
  if (isset($_POST['pilih'])) {
    $id_cluster = $_GET['id'];
    $id_alternatif = $_POST['id_alternatif'];

    $sql = "update cluster set id_alternatif='$id_alternatif' where id_cluster='$id_cluster'";
    $con->query($sql); 

    echo "<script>alert('Cluster telah ditetapkan!');window.location.href='index.php?p=cluster'</script>";
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
          <form method="post">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Opsi</th>
              <th>No</th>
              <th>Alternatif</th>
              <?php   
                    $sql = "select * from kriteria";
                    $query = mysqli_query($con, $sql);
                    while ($data = mysqli_fetch_assoc($query)):
               ?>
                
                <th><?= $data['kriteria'] ?></th>
             <?php endwhile; ?>
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
                <td><input type="radio" name="id_alternatif" value="<?= $row['id_alternatif'] ?>" <?= ($no==1)?"checked":"" ?>></td>
                <td><?= $no ?></td>
                <td><?= $row['nama_alternatif'] ?></td>
                
                <?php 
                    $sql2 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]'";
                    $query2 = mysqli_query($con, $sql2);
                    while($row2 = mysqli_fetch_assoc($query2)):
                ?>
                  <td><?= $row2['nilai'] ?></td>
                <?php endwhile; ?>

               </tr>
              <?php endwhile; ?>
            </tbody>
            <tfoot>
              <tr>
                <th><button type="submit" class="btn btn-primary" name="pilih">Pilih Cluster</button></th>
              </tr>
            </tfoot>
          </table>
          </form>

          <!-- <a href="index.php?p=alternatif&act=create" class="btn btn-primary" style="margin-top: 10px;">Tambah Alternatif</a> -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->