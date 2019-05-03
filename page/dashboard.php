
	 <?php if (@$_SESSION['logged'] == true): ?>
		
        <div class="callout callout-info">
          <h4>Selamat datang <?= $_SESSION['name'] ?></h4>

          <p>Sistem penunjang keputusan varietas bibit cabai kriting terbaik dengan menerapkan metode Fuzzy AHP</p>
        </div>
    <?php else: ?>

    <?php 

      $sql = "TRUNCATE TABLE cluster";
      $con->query($sql);

      $sql = "TRUNCATE TABLE nilai_alternatif";
      $con->query($sql);

      $sql = "TRUNCATE TABLE alternatif";
      $con->query($sql);

    ?>

		<div class="callout callout-info">
          <h4>Selamat datang</h4>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur voluptates, aspernatur odit similique provident, quaerat aliquid quae impedit repellat commodi iste laudantium non quos porro nemo nulla voluptas earum doloribus.</p>
        </div>
    
      <a href='?p=alternatif' class="btn btn-success">Mulai Perhitungan</a>
          </div>
    <?php endif; ?>
        