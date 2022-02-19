<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{


    // Sắp xếp bằng ajax của shop và category
    public function shopSort($id){

//        echo 'hi '.$id;
//        die;
        $data = explode("_",$id);
        $column = $data[0];
        $sort = $data[1];

        if ($column == 'name'){
            $products = Product::orderBy('name',$sort)->get()->toArray();
            foreach($products as $product)
                    {
                ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                             alt="Berry Lace Dress">
                                        <div>
                                            <a href="<?php echo url($product['image_feature_path']); ?>"
                                               class="btn btn-default fancybox-button">Zoom</a>
                                            <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                               class="btn btn-default fancybox-fast-view">View</a>
                                        </div>
                                    </div>
                                    <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                                    </h3>
                                    <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                                    <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                                </div>
                                <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                                    <div class="product-page product-pop-up">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-3">
                                                <div class="product-main-image">
                                                    <img src="<?php echo url($product['image_feature_path']) ?>"
                                                         alt="Cool green dress with red bell" class="img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-9">
                                                <h2><?php echo $product['name'] ?></h2>
                                                <div class="price-availability-block clearfix">
                                                    <div class="price">
                                                        <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                            <span>VND</span></strong>
                                                    </div>
                                                    <div class="availability">
                                                    Trạng thái:
                                                        <?php if($product['quantity'] > 0){ ?>
                                                                <strong>Còn hàng</strong>
                                                             <?php }else{ ?>
                                                                <strong>Hết hàng</strong>
                                                            <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="description">
                                                    <p><?php echo $product['short_description'] ?> </p>
                                                    <div class="product-page-cart">
                                                        <div class="product-quantity">
                                                            <input id="product-quantity" type="text" value="1" readonly
                                                                   name="product-quantity"
                                                                   class="form-control input-sm">
                                                        </div>
                                                        <a class="btn btn-primary"
                                                           href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                            vào giỏ</a>
                                                        <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                                           class="btn btn-default">Chi tiết</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                <?php }
        elseif ($column == 'price'){
//            print_r($column.'=>'.$sort);
            $products = Product::orderBy('price',$sort)->get()->toArray();

            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
         <?php }
      }

    public function categorySort($id,$sort){
        $data = explode("_",$sort);
        $column = $data[0];
        $sort = $data[1];

        if($column == 'name'){
            $products = Product::where('category_id',$id)->orderBy('name',$sort)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php }
        else if($column == 'price'){
            $products = Product::where('category_id',$id)->orderBy('price',$sort)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php }
    }

    // Hiển thị số lượng sản phẩm bằng ajax của Shop và Category
    public function showShop($limit){
        $products = Product::take($limit)->get()->toArray();

        foreach($products as $product)
        {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                             alt="Berry Lace Dress">
                        <div>
                            <a href="<?php echo url($product['image_feature_path']); ?>"
                               class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up-<?php echo $product['id'] ?>"
                               class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                    </h3>
                    <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                    <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                </div>
                <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                    <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                                <div class="product-main-image">
                                    <img src="<?php echo url($product['image_feature_path']) ?>"
                                         alt="Cool green dress with red bell" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                <h2><?php echo $product['name'] ?></h2>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                            <span>VND</span></strong>
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        <?php if($product['quantity'] > 0){ ?>
                                            <strong>Còn hàng</strong>
                                        <?php }else{ ?>
                                            <strong>Hết hàng</strong>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <p><?php echo $product['short_description'] ?> </p>
                                    <div class="product-page-cart">
                                        <div class="product-quantity">
                                            <input id="product-quantity" type="text" value="1" readonly
                                                   name="product-quantity"
                                                   class="form-control input-sm">
                                        </div>
                                        <a class="btn btn-primary"
                                           href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                            vào giỏ</a>
                                        <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                           class="btn btn-default">Chi tiết</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php

    }

    public function categoryShow($id,$limit){
//        echo 'id: '.$id.' limit: '.$limit;
        $products = Product::where('category_id',$id)->take($limit)->get()->toArray();
        foreach($products as $product)
        {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                             alt="Berry Lace Dress">
                        <div>
                            <a href="<?php echo url($product['image_feature_path']); ?>"
                               class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up-<?php echo $product['id'] ?>"
                               class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                    </h3>
                    <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                    <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                </div>
                <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                    <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                                <div class="product-main-image">
                                    <img src="<?php echo url($product['image_feature_path']) ?>"
                                         alt="Cool green dress with red bell" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                <h2><?php echo $product['name'] ?></h2>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                            <span>VND</span></strong>
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        <?php if($product['quantity'] > 0){ ?>
                                            <strong>Còn hàng</strong>
                                        <?php }else{ ?>
                                            <strong>Hết hàng</strong>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <p><?php echo $product['short_description'] ?> </p>
                                    <div class="product-page-cart">
                                        <div class="product-quantity">
                                            <input id="product-quantity" type="text" value="1" readonly
                                                   name="product-quantity"
                                                   class="form-control input-sm">
                                        </div>
                                        <a class="btn btn-primary"
                                           href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                            vào giỏ</a>
                                        <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                           class="btn btn-default">Chi tiết</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php

    }

    //Hiển thị sản phẩm hết hàng hoặc còn hàng của Shop và Category
    public function filterStockShop($symbol){
//        echo 'controller: '.$symbol;

        $products = Product::where('quantity',$symbol,0)->get()->toArray();
        foreach($products as $product)
        {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                             alt="Berry Lace Dress">
                        <div>
                            <a href="<?php echo url($product['image_feature_path']); ?>"
                               class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up-<?php echo $product['id'] ?>"
                               class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                    </h3>
                    <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                    <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                </div>
                <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                    <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                                <div class="product-main-image">
                                    <img src="<?php echo url($product['image_feature_path']) ?>"
                                         alt="Cool green dress with red bell" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                <h2><?php echo $product['name'] ?></h2>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                            <span>VND</span></strong>
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        <?php if($product['quantity'] > 0){ ?>
                                            <strong>Còn hàng</strong>
                                        <?php }else{ ?>
                                            <strong>Hết hàng</strong>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <p><?php echo $product['short_description'] ?> </p>
                                    <div class="product-page-cart">
                                        <div class="product-quantity">
                                            <input id="product-quantity" type="text" value="1" readonly
                                                   name="product-quantity"
                                                   class="form-control input-sm">
                                        </div>
                                        <a class="btn btn-primary"
                                           href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                            vào giỏ</a>
                                        <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                           class="btn btn-default">Chi tiết</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php

    }
    public function filterStockCategory($category,$symbol){
        $products = Product::where('category_id',$category)->where('quantity',$symbol,0)->get()->toArray();
        foreach($products as $product)
        {
            ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                             alt="Berry Lace Dress">
                        <div>
                            <a href="<?php echo url($product['image_feature_path']); ?>"
                               class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up-<?php echo $product['id'] ?>"
                               class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                    </h3>
                    <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                    <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                </div>
                <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                    <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                                <div class="product-main-image">
                                    <img src="<?php echo url($product['image_feature_path']) ?>"
                                         alt="Cool green dress with red bell" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                <h2><?php echo $product['name'] ?></h2>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                            <span>VND</span></strong>
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        <?php if($product['quantity'] > 0){ ?>
                                            <strong>Còn hàng</strong>
                                        <?php }else{ ?>
                                            <strong>Hết hàng</strong>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="description">
                                    <p><?php echo $product['short_description'] ?> </p>
                                    <div class="product-page-cart">
                                        <div class="product-quantity">
                                            <input id="product-quantity" type="text" value="1" readonly
                                                   name="product-quantity"
                                                   class="form-control input-sm">
                                        </div>
                                        <a class="btn btn-primary"
                                           href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                            vào giỏ</a>
                                        <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                           class="btn btn-default">Chi tiết</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
    }


    // filter price range category and shop
    public function filterPriceShop($value){
        $data = explode('_',$value);

        if (count($data) == 2 ){
            $symbol = $data[0];
            $number = $data[1];

            $products = $products = Product::where('price',$symbol,$number)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }else if(count($data) == 3){
            $min = $data[0];
            $symbol = $data[1];  // <
            $max = $data[2];

            // $min < price < $max
            $products = Product::where('price','>',$min)->where('price',$symbol,$max)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }
    }

    public function filterPriceCategory($category,$value){
        $data = explode('_',$value);

        if (count($data) == 2 ){
            $symbol = $data[0];
            $number = $data[1];

            $products = Product::where('category_id',$category)->where('price',$symbol,$number)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }else if(count($data) == 3){
            $min = $data[0];
            $symbol = $data[1];  // <=
            $max = $data[2];

            // $min < price < $max
            $products = Product::where('category_id',$category)->where('price','>',$min)->where('price',$symbol,$max)->get()->toArray();
            foreach($products as $product)
            {
                ?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="product-item">
                        <div class="pi-img-wrapper">
                            <img src="<?php echo url($product['image_feature_path']); ?>" class="img-responsive"
                                 alt="Berry Lace Dress">
                            <div>
                                <a href="<?php echo url($product['image_feature_path']); ?>"
                                   class="btn btn-default fancybox-button">Zoom</a>
                                <a href="#product-pop-up-<?php echo $product['id'] ?>"
                                   class="btn btn-default fancybox-fast-view">View</a>
                            </div>
                        </div>
                        <h3><a href="<?php echo route('item',['id' => $product['id']]); ?>"><?php echo $product['name'] ?></a>
                        </h3>
                        <div class="pi-price"><?php echo number_format($product['price'], 0, ',', '.') ?> VND</div>
                        <a href="<?php echo route('cart.add',['id' => $product['id']]) ?>"
                           class="btn btn-default add2cart">Thêm vào giỏ</a>
                    </div>
                    <div id="product-pop-up-<?php echo $product['id'] ?>" style="display: none; width: 700px;">
                        <div class="product-page product-pop-up">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-3">
                                    <div class="product-main-image">
                                        <img src="<?php echo url($product['image_feature_path']) ?>"
                                             alt="Cool green dress with red bell" class="img-responsive">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-9">
                                    <h2><?php echo $product['name'] ?></h2>
                                    <div class="price-availability-block clearfix">
                                        <div class="price">
                                            <strong><?php echo number_format($product['price'], 0, ',', '.') ?>
                                                <span>VND</span></strong>
                                        </div>
                                        <div class="availability">
                                            Trạng thái:
                                            <?php if($product['quantity'] > 0){ ?>
                                                <strong>Còn hàng</strong>
                                            <?php }else{ ?>
                                                <strong>Hết hàng</strong>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p><?php echo $product['short_description'] ?> </p>
                                        <div class="product-page-cart">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="1" readonly
                                                       name="product-quantity"
                                                       class="form-control input-sm">
                                            </div>
                                            <a class="btn btn-primary"
                                               href="<?php echo route('cart.add',['id' => $product['id']]) ?>">Thêm
                                                vào giỏ</a>
                                            <a href="<?php echo route('item',['id' => $product['id']]) ?>"
                                               class="btn btn-default">Chi tiết</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }
    }



}

