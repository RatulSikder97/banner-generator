<?php include "layouts/header.php"; ?>

<h3><?= $pageTitle ?></h3>

<form action="/banner/image-banner" method="post">
    <input type="hidden" name="bannerType" value="image">
    <div class="mb-3">
        <label for="banner-img-url" class="form-label">Banner Img Url <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="bannerImg" placeholder="Enter Banner URL" required>
    </div>

    <div class="mb-3">
        <label for="banner-link" class="form-label">Banner Link <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="bannerLink" placeholder="Enter Banner Link" required>
    </div>

    <button class="btn btn-success">Generate</button>
</form>

<?php include "layouts/footer.php"; ?>