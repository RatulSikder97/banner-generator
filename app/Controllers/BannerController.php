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

    function singleProductBannerNarrow() {
        include "./resources/views/single-product-banner-narrow.php";
    }


    function generateSingleProductBannerNarrow() {
        $productId = $_POST['productId'];

        $productRes = HTTP_CLIENT->request('GET', 'https://ecommerce.rokomariapi.com/ecom/api/product/'.$productId, [
            'headers' => [
                'app_api_key' => 'lXwVZYyT9axBqFYjRDTKYIXynsi96cg70aAzsC8BB5P9q60cjK6JglnYJ9MkaQjB98aRClYNukwOYuqf236gata'
            ]
        ]);

        if($product = json_decode($productRes->getBody())) {
        

            if($product->listPrice != $product->sellPrice) {
                $productHtml = '<div class="rok-product-banner" style="max-width: 900px; margin: 20px auto;position:relative; background: #FFFBF1; border: 1px solid #F9DBB8; border-radius: 12px; padding: 14px 24px; display: flex;justify-content: start;align-items: center;">
                                    <span style="color: #aaa; font-size:10px; position: absolute; right: 10px; bottom: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span>
                                
                                    <a href="https://www.rokomari.com/book/'.$product->id.'">
                                        <img src="'.$product->image.'" style="mix-blend-mode: multiply; width: 65px; margin: 0 30px;" alt="banner-image">
                                    </a>
                                
                                    <div class="info" style="margin-left: 16px;">
                                        <a href="https://www.rokomari.com/book/'.$product->id.'" style="text-decoration: none;color: #333;">
                                            <p class="title" style="font-size: 18px;font-weight:700;margin-bottom: 5px; width:570px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">'.$product->nameBangla.'</p>
                                        </a>
                                        <p class="title" style="font-style: 14px;color: #888;margin: 0;">by <span style="color: #0397d3 ;width: 480px;white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">'.$product->authorNameBangla.'</span> </p>
                                        <p class="price" style="font-weight: bold;font-size: 16px; margin-top: 10px;"><span class="mrp" style="color: #666;text-decoration: line-through; margin-right: 10px;">৳'.$product->listPrice.'</span> <span class="payable">৳'.$product->sellPrice.'</span></p>
                                    </div>
                                
                                    <button class="btn  cart-btn js--add-to-cart" product-id="'.$product->id.'" style="color: #fff; height: auto; margin-left: auto; background: #ff9900; border:none; border-radius: 4px;padding: 8px 10px; font-size:18px;width:140px;cursor: pointer;">Add to Cart</button></div>';
            } else {
                $productHtml = '<div class="rok-product-banner" style="max-width: 900px; margin: 20px auto;position:relative; background: #FFFBF1; border: 1px solid #F9DBB8; border-radius: 12px; padding: 14px 24px; display: flex;justify-content: start;align-items: center;">
                                    <span style="color: #aaa; font-size:10px; position: absolute; right: 10px; bottom: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span>
                                
                                    <a href="https://www.rokomari.com/book/'.$product->id.'">
                                        <img src="'.$product->image.'" style="mix-blend-mode: multiply; width: 65px; margin: 0 30px;" alt="banner-image">
                                    </a>
                                
                                    <div class="info" style="margin-left: 16px;">
                                        <a href="https://www.rokomari.com/book/'.$product->id.'" style="text-decoration: none;color: #333;">
                                            <p class="title" style="font-size: 18px;font-weight:700;margin-bottom: 5px; max-width:510px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;">'.$product->nameBangla.'</p>
                                        </a>
                                        <p class="title" style="font-style: 14px;color: #888;margin: 0;">by <span style="color: #0397d3 ;width: 480px;white-space:nowrap; overflow:hidden;text-overflow:ellipsis;">'.$product->authorNameBangla.'</span> </p>
                                        <p class="price" style="font-weight: bold;font-size: 16px; margin-top: 10px;"> <span class="payable">৳'.$product->sellPrice.'</span></p>
                                    </div>
                                
                                    <button class="btn  cart-btn js--add-to-cart" product-id="'.$product->id.'" style="color: #fff; height: auto; margin-left: auto; border:none; border-radius: 4px;padding: 8px 10px; font-size:18px;width:140px;cursor: pointer;">Add to Cart</button></div>';
            }
            
            
            $_SESSION['banner'] = minifier($productHtml);
        }

        return route('/banner/generated');
    }


    function singleProductBannerMobile() {
        include "./resources/views/single-product-banner-mobile.php";
    }


    function generateSingleProductBannerMobile() {
        $productId = $_POST['productId'];

        $productRes = HTTP_CLIENT->request('GET', 'https://ecommerce.rokomariapi.com/ecom/api/product/'.$productId, [
            'headers' => [
                'app_api_key' => 'lXwVZYyT9axBqFYjRDTKYIXynsi96cg70aAzsC8BB5P9q60cjK6JglnYJ9MkaQjB98aRClYNukwOYuqf236gata'
            ]
        ]);

        if($product = json_decode($productRes->getBody())) {
            // image section
            $imageSec = '<a href="https://www.rokomari.com/book/'.$product->id.'">
                            <img src="'.$product->image.'" style="mix-blend-mode: multiply; width: 75px; margin: 20px auto;" alt="banner-image"> </a>';
    
            // rating calc
            $starSection ="";
            if($product->averageRating > 0) {
    
                $fullStar = (int) $product->averageRating;
                $halfStar =  fmod($product->averageRating, 1) > 0 ? 1 : 0;
                $emptyStar = 5 - $fullStar - $halfStar;
                $starSection = str_repeat('<i class="ion-ios-star px-1"></i>',  $fullStar)
                                .str_repeat('<i class="ion-ios-star-half px-1"></i>',  $halfStar)
                                .str_repeat('<i class="ion-ios-star-outline px-1"></i>',  $emptyStar);
            }
    
            $productInfo = '<a href="https://www.rokomari.com/book/'.$product->id.'"style="text-decoration: none;color: #333;">
                                <p class="title" style="font-size: 16px;margin-bottom: 10px;">'.$product->nameBangla.'</p> </a>
                            <p class="title" style="font-style: 12px;color: #888;margin: 0;">By: <span style="color: #0397d3">'.$product->authorNameBangla.'</span> </p>';
            $productRating=' <div class="rating" style="color: #ff9900;">'.$starSection.'</div>';
            if($product->listPrice > $product->sellPrice) {
                $productPrice ='<p class="price" style="font-weight: bold;font-size: 16px; margin-top: 10px;"><span class="mrp" style="color: #666;text-decoration: line-through; margin-right: 10px;">TK. '.$product->listPrice.'</span> <span class="payable">TK. '.$product->sellPrice.'</span></p>';
            } else {
                $productPrice ='<p class="price" style="font-weight: bold;font-size: 16px; margin-top: 10px;"><span class="payable">TK. '.$product->sellPrice.'</span></p>';
            }
    
            $productHtml = '<div class="rok-product-banner" style="max-width: 480px; width: 95%; margin: 16px auto;position:relative; background: linear-gradient(to bottom, #FFFBF1, #FFFBF1); border: 1px solid #F9DBB8; border-radius: 12px; padding: 15px; display: flex;justify-content: center; flex-direction:column; align-items: center; text-align: center;">
            <span style="color: #aaa; font-size:10px; position: absolute; right: 10px; top: -12px;"><i class="ion-information-circled" style="font-size: 10px;"></i> sponsored</span>
            '.$imageSec.'
                <div class="info text-center">
                '.$productInfo.'
                '.$productRating.'
                '. $productPrice.'
                </div>
    
                <button class="btn js--add-to-cart" product-id="'.$product->id.'" style="margin: auto; margin-top: 16px; background: #ffc107; border:none; border-radius: 4px;padding: 8px 10px; font-size:14px;width:140px;cursor: pointer;" >Add to Cart</button>
            </div>';
    
            $_SESSION['banner'] = minifier($productHtml);
        }

        return route('/banner/generated');
    }

    function generatedBanner() {
        include "./resources/views/generated-banner.php";
    }
}
