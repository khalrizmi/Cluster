<?php 
  
    $kumpulan = [];
    $no = 0;
    $sql = "select * from alternatif";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)){
          $no++;
          $ni = 0;
          $sql2 = "select * from nilai_alternatif where id_alternatif='$row[id_alternatif]'";
          $query2 = mysqli_query($con, $sql2);
          while($row2 = mysqli_fetch_assoc($query2)){
            $ni++;
            $kumpulan[$no][$ni] = $row2['nilai'];
     
        }
    }
 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Implementasi perhitungan dengan menggunakan metode K-means dan cluster</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
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
             <?php   
                    $no = 0;
                    $sql = "select * from cluster";
                    $query = mysqli_query($con, $sql);
                    while ($data = mysqli_fetch_assoc($query)): $no++;
               ?>
               <th><?= "cluster $no" ?></th>
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

              
                  
                </td>
                    <?php 
                      
                      $sql3 = "select * from cluster";
                      $query3 = mysqli_query($con, $sql3);
                      while($row3 = mysqli_fetch_assoc($query3)): 
                    ?>
                      <td>
                         <?php 
                             $hasil = 0;
                             $ni = 0;
                             $sql4 = "select * from nilai_alternatif where id_alternatif='$row3[id_alternatif]'";
                             $query4 = mysqli_query($con, $sql4);
                             while ($row4 = mysqli_fetch_assoc($query4)) {
                              $ni++;
                               // echo $kumpulan[$no][$ni]." ";
                              
                                $hasil = $hasil + (pow($kumpulan[$no][$ni] - $row4['nilai'], 2));
                             }

                             echo round(sqrt($hasil), 9);
                          ?> 
                      </td>
                    <?php endwhile; ?>
                     

                  </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <!-- <a href="index.php?p=alternatif&act=create" class="btn btn-primary" style="margin-top: 10px;">Tambah Alternatif</a> -->
          <a href="index.php?p=implementasi_baru" class="btn btn-success" style="margin: 10px 20px 0 0; float: right;">Lanjutkan</a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->