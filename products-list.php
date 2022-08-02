<?php
define("95495036eb814b2fb6b1bc61dee0884c5570b46c0b1166c3cd7c6b24922fb3ce", "");
require_once("header.php");
$Categories = $db->select("*", "category")->get_all();
$SelectedCategory = $db->select("CategoryId", "category")->where("Url=?", [$_GET["category"]])->get_column();
$CategorySizes = json_decode($db->select("Size", "category")->where("CategoryId=?", [$SelectedCategory])->get_row()["Size"]);
$Styles = $db->select("*", "style")->get_all();

$QueryString = "CategoryId=?";
$QueryParams = [$SelectedCategory];

//* GET Paremeters default values
$Page = 1;
$Gender = false;
$Style = false;
$Size = false;
$MinPrice = false;
$MaxPrice = false;
$GetString = "";

//* GET Parameters control
if (isset($_GET["gender"])) {
    if ($_GET["gender"] == "m" || $_GET["gender"] == "f") {
        $QueryString .= " and Gender=?";
        array_push($QueryParams, mb_strtoupper($_GET["gender"], "utf-8"));
        $GetString .= "&gender=" . $_GET["gender"];
    }
}
if (isset($_GET["minprice"]) && !isset($_GET["maxprice"])) {
    if (is_numeric($_GET["minprice"])) {
        if ($_GET["minprice"] > 0) {
            $QueryString .= " and Price>=?";
            array_push($QueryParams, (int)$_GET["minprice"]);
            $GetString .= "&minprice=" . (int)$_GET["minprice"];
        }
    }
} elseif (!isset($_GET["minprice"]) && isset($_GET["maxprice"])) {
    if (is_numeric($_GET["maxprice"])) {
        if ($_GET["maxprice"] > 0) {
            $QueryString .= " and Price<=?";
            array_push($QueryParams, (int)$_GET["maxprice"]);
            $GetString .= "&maxprice=" . (int)$_GET["maxprice"];
        }
    }
} elseif (isset($_GET["minprice"]) && isset($_GET["maxprice"])) {
    if (is_numeric($_GET["minprice"]) && is_numeric($_GET["maxprice"])) {
        if ($_GET["minprice"] > 0 && $_GET["maxprice"] > 0 && $_GET["minprice"] < $_GET["maxprice"]) {
            $QueryString .= " and Price>=? and Price<=?";
            array_push($QueryParams, (int)$_GET["minprice"], (int)$_GET["maxprice"]);
            $GetString .= "&minprice=" . (int)$_GET["minprice"] . "&maxprice=" . (int)$_GET["maxprice"];
        }
    }
}
$Products = $db->select("*", "product")->where($QueryString, $QueryParams)->get_all();
$ProductsCount = $db->select("count(*)", "product")->where($QueryString, $QueryParams)->get_column();

$ItemsPerPage = 18;
$TotalPage = ceil($ProductsCount / $ItemsPerPage);
if (isset($_GET["page"])) {
    if (is_numeric($_GET["page"])) {
        if ($_GET["page"] > 1 && $_GET["page"] <= $TotalPage) {
            $Page = (int)$_GET["page"];
        }
    }
}
$StartedIndex = $Products[($Page - 1) * $ItemsPerPage]["ProductId"];
$QueryString .= " and ProductId>=?";
array_push($QueryParams, $StartedIndex);
$Products = $db->select("*", "product")->where($QueryString, $QueryParams)->limit($ItemsPerPage)->get_all();

parse_str($GetString, $GetArray);
?>
<section id="advertisement">
    <div class="container">
        <img src="images/shop/advertisement.jpg" alt="" />
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php require_once("filter.php"); ?>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <div class="onload"></div>
                    <!--features_items-->
                    <h2 class="title text-center">Ürünler</h2>
                    <div class="col-sm-12 current-filters">
                        <?php
                        if ($GetArray) {
                            foreach ($GetArray as $key => $value) {
                                switch ($key) {
                                    case 'gender': ?>
                                        <div class="current-filter-group">
                                            <div class="current-filter">
                                                <h5>Cinsiyet</h5>
                                                <span><?php echo $value == "m" ? "Erkek" : "Kadın" ?></span>
                                            </div>
                                            <button filter="<?php echo $key ?>" type="button" class="remove-filter"><i class="fa fa-times"></i></button>
                                        </div>
                                    <?php break;
                                    case 'minprice': ?>
                                        <div class="current-filter-group">
                                            <div class="current-filter">
                                                <h5>En az</h5>
                                                <span><?php echo $value ?>TL</span>
                                            </div>
                                            <button filter="<?php echo $key ?>" type="button" class="remove-filter"><i class="fa fa-times"></i></button>
                                        </div>
                                    <?php break;
                                    case 'maxprice': ?>
                                        <div class="current-filter-group">
                                            <div class="current-filter">
                                                <h5>En fazla</h5>
                                                <span><?php echo $value ?>TL</span>
                                            </div>
                                            <button filter="<?php echo $key ?>" type="button" class="remove-filter"><i class="fa fa-times"></i></button>
                                        </div>
                                <?php break;
                                }
                                ?>

                        <?php }
                        } ?>
                    </div>
                    <div id="product-list" class="col-sm-12">
                        <?php
                        if ($Products) {
                            foreach ($Products as $Product) { ?>
                                <div class="col-sm-4" style="height:550px ;">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="<?php echo URL . "/" . $_GET["category"] . "/" . $Product["Url"] ?>">
                                                    <img src="<?php echo URL ?>/images/products/<?php echo $Product["Cover"] ?>" alt="" />
                                                </a>
                                                <h2><?php echo $Product["Price"] ?> TL</h2>
                                                <p><?php echo $Product["Name"] ?></p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete ekle</a>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>İstek listesine ekle</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<h5>Bu kategoriye henüz ürün eklenmemiş</h5>";
                        }
                        ?>
                    </div>

                </div>
                <!--features_items-->
            </div>
            <div class="col-sm-12 text-center">
                <ul class="pagination">
                    <?php
                    $PageUrl = URL . "/" . $_GET["category"] . $GetString . "&page=";
                    echo $Page > 1 ? "<li><a href='$PageUrl" . ($Page - 1) . "'>&laquo;</a></li>" : '';
                    for ($i = $Page - 2; $i <= $Page + 2; $i++) {
                        if ($i < 1) {
                            continue;
                        }
                        if ($i > $TotalPage) {
                            break;
                        }
                        if ($i == $Page) {
                            echo "<li class='active'><a href='$PageUrl$i'>$i</a></li>";
                        } else {
                            echo "<li class=''><a href='$PageUrl$i'>$i</a></li>";
                        }
                    }
                    echo $Page < $TotalPage ? "<li><a href='$PageUrl" . ($Page + 1) . "'>&raquo;</a></li>" : '';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php require_once("footer.php"); ?>
<script src="<?php echo URL ?>/js/filter.js"></script>
</body>

</html>