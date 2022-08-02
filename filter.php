<div class="left-sidebar">
    <input type="hidden" name="categoryid" value="<?php echo $SelectedCategory ?>">
    <h2>Kategori</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        <!-- <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        Sportswear
                    </a>
                </h4>
            </div>
            <div id="sportswear" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li><a href="#">Nike </a></li>
                        <li><a href="#">Under Armour </a></li>
                        <li><a href="#">Adidas </a></li>
                        <li><a href="#">Puma</a></li>
                        <li><a href="#">ASICS </a></li>
                    </ul>
                </div>
            </div>
        </div> -->
        <?php
        foreach ($Categories as $Category) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="<?php echo URL . "/" . $Category["Url"] ?>"><?php echo $Category["Name"] ?></a></h4>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php
    if (isset($SelectedCategory)) { ?>
        <div class="panel-group category-products" id="accordian">
            <form id="filters" method="post">
                <div class="filter-options">
                    <div class="filter-option">
                        <label>Cinsiyet</label>
                        <select name="gender">
                            <option value="0" selected disabled>Seçiniz</option>
                            <option value="m">Erkek</option>
                            <option value="f">Kadın</option>
                        </select>
                    </div>

                    <div class="filter-option">
                        <label>Tarz</label>
                        <select name="style">
                            <option value="0" selected disabled>Seçiniz</option>
                            <?php
                            foreach ($Styles as $Style) {
                                echo "<option value='" . $Style["StyleId"] . "'>" . $Style["Name"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="filter-option">
                        <label>Beden</label>
                        <div class="size">
                            <?php
                            foreach ($CategorySizes as $key => $value) { ?>
                                <div class="size-group">
                                    <input name="size" id="size-<?php echo $key ?>" type="radio" value="<?php echo $value ?>">
                                    <label for="size-<?php echo $key ?>"><?php echo $value ?></label>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>

                    <div class="filter-option">
                        <label>Fiyat</label>
                        <div class="price">
                            <div>
                                <input name="minprice" type="number" placeholder="En az">
                            </div>
                            <strong>-</strong>
                            <div>
                                <input name="maxprice" type="number" placeholder="En çok">
                            </div>
                        </div>
                    </div>

                    <div class="filter-apply">
                        <button type="submit" class="btn btn-success" disabled>Uygula</button>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
    <!--/category-products-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="<?php echo URL ?>/images/home/shipping.jpg" alt="" />
    </div>
    <!--/shipping-->

</div>