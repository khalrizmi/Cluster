<?php 

  

 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Alternatif</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table  class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Cluster</th>
                <?php 
                    $jumlah_kolom = 0;
                    $sql = "select * from kriteria";
                    $query = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($query)):
                      $jumlah_kolom++;
                 ?>
                 <th><?= $jumlah_kolom; ?></th>
                <?php endwhile; ?>
              </tr>
            </thead>
            <tbody>
              <?php 
                $selesai = 0;
                $no = 0;
                $sql = "select * from cluster";
                $query = mysqli_query($con, $sql);
                $jumlah_cluster = mysqli_num_rows($query);
                while ($row = mysqli_fetch_assoc($query)):
                  $no++;
               ?>
                <tr>
                    <td>Cluster <?= $no ?></td>
                    <?php 
                      if($row['id_alternatif'] == 0){
                        echo "
                        <td align='center' colspan=$jumlah_kolom>
                            <a href='index.php?p=cluster&act=pilih&id=$row[id_cluster]' class='btn btn-primary'>Silahkan Pilih</a>
                        </td>";
                      } else {

                        $sql2 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]'";
                        $query2 = mysqli_query($con, $sql2);
                        while ($row2 = mysqli_fetch_assoc($query2)) {
                          echo "<td>$row2[nilai]</td>";
                        }

                        $selesai++;
                      }
                     ?>
                </tr>
              <?php endwhile; ?>
            </tbody>
            <?php 
                if ($selesai == $jumlah_cluster) {
             ?>
            <tfoot>
              <tr>
                <th colspan="<?= $jumlah_kolom+1 ?>">
                  <a href="index.php?p=implementasi" class="btn btn-success" style="float: right;margin-right: 20px;">Lanjutkan</a>
                </th>
              </tr>
            </tfoot>
          <?php } ?>
          </table>  
        
        </br>

          <table  class="table table-bordered table-striped">
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

               </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <!-- <a href="index.php?p=cluster&act=jumlah" class="btn btn-success" style="margin: 10px 20px 0 0; float: right;">Lanjutkan</a> -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->