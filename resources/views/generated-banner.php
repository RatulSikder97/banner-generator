<?php include "layouts/header.php"; ?>

<h3>Generated Banner</h3>

<div class="gen-banner">
    <?php if (isset($_SESSION['banner'])) { echo $_SESSION['banner']; }?>
</div>

<textarea name="" class="form-control mt-5" id="" cols="30" rows="10" autofocus onfocus="this.select()" readonly>  <?php if (isset($_SESSION['banner'])) { echo $_SESSION['banner']; }?></textarea>

<button class="btn btn-primary mt-3">Copy Banner</button>



<?php include "layouts/footer.php"; ?>