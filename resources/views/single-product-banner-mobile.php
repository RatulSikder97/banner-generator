<?php include "layouts/header.php"; ?>
<h3>Single Product Banner</h3>

<form action="/banner/single-product-mobile" method="post">
    <input type="hidden" name="bannerType" value="singleProductBanner">
    <div class="mb-3">
        <label class="form-label">Product ID <span class="text-danger">*</span></label>
        <input type="number" class="form-control" name="productId" placeholder="Enter ProductId" required>
    </div>

    <button class="btn btn-success">Generate</button>
</form>

<?php include "layouts/footer.php"; ?>