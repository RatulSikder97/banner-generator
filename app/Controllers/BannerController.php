<?php
namespace App\Controllers;

use function App\Config\minifier;
use function App\Services\route;

class BannerController  {

    function index() {
        include "./resources/views/home.php";
    }

    function imageBanner() {
        $pageTitle = "Image Banner";
        include "./resources/views/image-banner.php";
    }

    function singleProductBanner() {
        include "./resources/views/single-product-banner.php";
    }

    
    function generateImageBanner() {
        $bannerImg = $_REQUEST['bannerImg'];
        $bannerLink = $_REQUEST['bannerLink'];
    
    
        $bannerHtml = '<a href="'.$bannerLink.'?ref=img_banner_ad" style="display:block; max-height: 300px; max-width: 1100px; margin: 20px auto;position:relative;"><span style="color: #838383; font-size:10px; position: absolute; right: 10px; bottom: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span><img src="'.$bannerImg.'"  style="width: 100% !important; height: 100%;" alt="revive test banner" /></a>';
        
        $_SESSION['banner'] = $bannerHtml;
        return route('/banner/generated');
    }

    function generateSingleProductBanner() {
        $productId = $_POST['productId'];

        $productRes = HTTP_CLIENT->request('GET', 'https://ecommerce.rokomariapi.com/ecom/api/product/'.$productId, [
            'headers' => [
                'app_api_key' => 'lXwVZYyT9axBqFYjRDTKYIXynsi96cg70aAzsC8BB5P9q60cjK6JglnYJ9MkaQjB98aRClYNukwOYuqf236gata'
            ]
        ]);

        if($product = json_decode($productRes->getBody())) {
            $productHtml = '<section class="single-product-ads" style="width: 288px; background: #fff; margin: 18px 0; border: 1px solid #D6D6D6; border-radius: 5px; box-sizing: border-box;position:relative;">
                                <span style="color: #838383; font-size:10px; position: absolute; right: 10px; bottom: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span>
                                <img src="'.$product->image.'" alt="" style="width: 100%; height: 160px; object-fit: contain; padding: 14px 0; border-radius: 5px 5px 0 0;">
    
                                <div class="content"  style="display: flex; box-sizing: border-box; width: 100%; padding: 14px; justify-content: space-between; align-items: flex-end;">
                                        <div class="info" style="width: 60%;">
                                            <a href="https://www.rokomari.com/book/'.$product->id.'?ref=spa" class="title" style="display: block; color: #000A14; text-decoration:none; font-size:14px; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'.$product->nameBangla.'</a>
                                            <p class="subtitle" style="font-size: 13px; color: #828588; margin: 5px 0;  max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'.$product->authorNameBangla.'</p>
                                            <p class="price" style="color:#000A14;font-size: 16px; margin: 0;"><span class="price" style="margin-right: 10px; font-weight: 500; text-decoration-line: line-through;color: #828588;">৳'.$product->listPrice.'</span> <span class="payable">৳'.$product->sellPrice.'</span></p>
                                        </div>
                                        
                                        <button class="btn cart-btn js--add-to-cart h-auto" product-id="'.$product->id.'" onclick="gtag('."'".'event'."'".','."'".'add_to_cart'."'".', { content_type: '."'".'ads_product'."'".', items: [ {item_id:'."'".''.$product->id.''."'".', price: '."'".''.$product->sellPrice.''."'".', quantity: 1}] })" style="border: none;padding: 8px 12px; cursor:pointer;font-size: 14px;color: #fff;background: #FF9900;border-radius: 4px;">Shop Now</button>
                                </div>
                            </section>';
            
            $_SESSION['banner'] = minifier($productHtml);
    
            // header('Location: ../generated-banner.php');
        }

        return route('/banner/generated');
    }


    function generatedBanner() {
        include "./resources/views/generated-banner.php";
    }
}
