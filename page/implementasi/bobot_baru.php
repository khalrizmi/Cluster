<?php 
  
    $kumpulan = [];
    $cluster = [];
    $jumlah_kluster = 0;

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

    $no = 0;
    $sql = "select * from alternatif";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)){
	    $no++;

	    $nol = 0;
	    $sql3 = "select * from cluster";
      	$query3 = mysqli_query($con, $sql3);
      	$jumlah_kluster = mysqli_num_rows($query3);
     	while($row3 = mysqli_fetch_assoc($query3)){
     		$nol++;

     		$hasil = 0;
         	$ni = 0;
         	$sql4 = "select * from nilai_alternatif where id_alternatif='$row3[id_alternatif]'";
         	$query4 = mysqli_query($con, $sql4);
         	while ($row4 = mysqli_fetch_assoc($query4)) {
          		$ni++;
           		// echo $kumpulan[$no][$ni]." ";
          
            	$hasil = $hasil + (pow($kumpulan[$no][$ni] - $row4['nilai'], 2));
         	}

         	$hasil = round(sqrt($hasil), 9);
         	$cluster[$no][$nol] = $hasil;


         	
         	// echo $cluster[$no][$nol]." ";
     	}
     	// echo "<br>";
	}


	// echo "<br><br>";

	// membandingkan

	$cluster_id = [];
	for ($i=1; $i <=$jumlah_kluster ; $i++) { 
      		
  		for ($u=0; $u <=100 ; $u++) { 
  			
  			$cluster_id[$i][$u] = "";
  		}
  	}

	$jumlah_banyak = 0;
	$no = 0;
	$no_pilihan = 0;
    $sql = "select * from alternatif";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($query)){
	    $no++;

	    $nilai = 0;
	    $huruf= "";
	    $nol = 0;
	    $sql3 = "select * from cluster";
      	$query3 = mysqli_query($con, $sql3);      	
     	while($row3 = mysqli_fetch_assoc($query3)){
     		$nol++;

			// echo "<font color='red'>".$cluster[$no][$nol]."</font> ";

     		if ($nol == 1) {
     			$nilai = $cluster[$no][$nol];
     			$huruf = $row['id_alternatif']."-".$nol;
     		} 

     		if ($cluster[$no][$nol] < $nilai) {
     			$nilai = $cluster[$no][$nol];
     			$huruf = $row['id_alternatif']."-".$nol;
     		} 
     		// else {
     		// 	$nilai = $nilai;
     		// 	$huruf = $nilai."-".$nol;
     		// }

     		// $cluster_id[$row3['id_cluster']][$nol] = $nilai;
     		



     		


     		// if ($nol == 1) {
     		// 	$nilai = $cluster[$no][$nol];
     		// 	$no_pilihan = 1;
     		// } else {

	      //    	if ($nilai < $cluster[$no][$nol]) {
	      //    		$jumlah_banyak++;

	      //    		$cluster_id[$jumlah_banyak] = $row['id_alternatif'];
	      //    		$nilai = $cluster[$no][$no_pilihan];
	      //    		// echo $nilai." ";	

	      //    	} else {
	      //    		// echo "besar ";
	      //    		$nilai = "besar";
	      //    	}
	      //    	echo $nilai;

	      //    	$no_pilihan++;
	      //    	// echo $cluster[$no][$nol]." ";
	      //    }


     	}

     	$pecah = explode("-", $huruf);

     	// echo $pecah[0]."-".$pecah[1];
     	// echo "<br>";


     	$cluster_id[$pecah[1]][$no] = $pecah[0];

     	
	}	


	// echo "<br><br>";

	$cluster_baru = [];

	for ($i=1; $i <= $jumlah_kluster; $i++) { 
		
		for ($u=1; $u <= 100; $u++) { 
			$cluster_baru[$i][$u] = "";
		}
	}

	$sql = "select * from kriteria";
	$query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($query)) {
		
		for ($i=1; $i <= $jumlah_kluster; $i++) { 
			
			$jumlah = 0;
			$number = 0;
			for ($u=1; $u <= 100; $u++) { 
				
				if ($cluster_id[$i][$u] != "") {
					$id = $cluster_id[$i][$u];
					$sql2 = "select * from nilai_alternatif where id_kriteria='$row[id_kriteria]' and id_alternatif='$id'";
					$query2 = mysqli_query($con, $sql2);
					$row2 = mysqli_fetch_assoc($query2);

					$jumlah += $row2['nilai'];
					// echo $row2['nilai']." ";
					// echo $id;
					$number++;

				} 

			}
			$jumlah = $jumlah/$number;
			
			// echo $jumlah . " - ". $i;

			// echo "<br>";

			$selesai = 0;
			for ($u=1; $u <= 100; $u++) { 

				if ($selesai == 0) {
					if ($cluster_baru[$i][$u] == "") {
					
						if ($jumlah == 0) {
							$jumlah = "0";
						}
						$cluster_baru[$i][$u] = $jumlah;
						$selesai = 1;
					}
				}
			}

		}
	}

	// echo "<br><br>";
	
	for ($i=1; $i <= $jumlah_kluster; $i++) { 
		for ($u=1; $u <= 100; $u++) { 

			if ($cluster_baru[$i][$u] != "") {
				
				// echo $cluster_baru[$i][$u]." ";
			}
		}
		// echo "<br>";
	}






 ?>

<div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Menghitung ulang dengan menggunakan bobot baru</h3>
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

              	$id_alternatif = 0;
                $no = 0;
                $sql = "select * from alternatif";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($query)):
	                $no++;
	                $id_alternatif = $row['id_alternatif'];
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
                      
                      $nol = 0;
                      $sql3 = "select * from cluster";
                      $query3 = mysqli_query($con, $sql3);
                      while($row3 = mysqli_fetch_assoc($query3)): 
                      	$nol++;
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
                              
                                $hasil = $hasil + (pow($kumpulan[$no][$ni] - $cluster_baru[$nol][$ni], 2));
                              // echo $kumpulan[$no][$ni]." ";

                             }

                             $hasil = round(sqrt($hasil), 9);
                             echo $hasil;
                          ?> 
                      </td>
                    <?php endwhile; ?>
                     

                  </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <!-- <a href="index.php?p=alternatif&act=create" class="btn btn-primary" style="margin-top: 10px;">Tambah Alternatif</a> -->
          <a href="index.php" class="btn btn-success" style="margin: 10px 20px 0 0; float: right;">Selesai</a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->