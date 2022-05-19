<section>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>Welcome To Graceful <br>A New Style!</h1>
                <p>
                    <b>FASSION IS ARMOR TO SURVIVE THE REALITY OF EVERYDAY LIFE !</b>
                </p>
                <a href="?control=category&id=all" class="btn">Explore Now &#8594;</a>
            </div>
            <div class="col-2">
                <img src="images/saigon1.png">
            </div>
        </div>
    </div>
</section>

</div>
<!------ feature categories ------->
<div class="categories">
    <div class="small-container">
        <div class="row">
            <div class="col-3">
                <img src="images/category-1.jpg">
            </div>
            <div class="col-3">
                <img src="images/category-2.jpg">
            </div>
            <div class="col-3">
                <img src="images/category-3.jpg">
            </div>
        </div>
    </div>

</div>
<!------ feature product ------->
<div class="small-container">
    <h2 class="title">Best Selling Products</h2>

    <div class="row" style="justify-content: unset;">
        <?php
        $sql_bestSell = mysqli_query($conn, 'SELECT * FROM product WHERE product_active = 1');
        for ($i = 0; $i < 4; $i++) {
            if ($bestSell = mysqli_fetch_array($sql_bestSell)) {
        ?>
                <div class="col-4">
                    <div class="p-relative">
                        <a href="?control=detail&id=<?php echo $bestSell['product_id'] ?>">
                            <img src="images/<?php echo $bestSell['product_image']; ?>">
                        </a>
                        <form action="?control=cart" method="POST">
                            <div class="block-addtocart-overlay">
                                <div class="block-addtocart">
                                    <input type="hidden" name="productName" value="<?php echo $bestSell['product_name'] ?>" />
                                    <input type="hidden" name="productID" value="<?php echo $bestSell['product_id'] ?>" />
                                    <input type="hidden" name="productPrice" value="<?php echo $bestSell['product_price'] ?>" />
                                    <input type="hidden" name="productIMG" value="<?php echo $bestSell['product_image'] ?>" />
                                    <input type="hidden" name="productQty" value="1" />
                                    <button class="but-addtocart fs15 hov1" type="submit" onclick="pop_up()"> ADD TO CART </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pdt-10">
                        <a href="?control=detail&id=<?php echo $bestSell['product_id'] ?>">
                            <h4 class="h4_product"><?php echo $bestSell['product_name']; ?></h4>
                        </a>
                        <p><?php echo '$' . number_format($bestSell['product_price'], 2); ?></p>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <h2 class="title">Latest Products</h2>
    <form action="?control=cart" method="POST">
        <div class="row" style="justify-content: unset;">
            <?php
            $sql_lastSell = mysqli_query($conn, 'SELECT * FROM product WHERE product_active = 1');
            for ($i = 0; $i < 8; $i++) {
                if ($lastProduct = mysqli_fetch_array($sql_lastSell)) {
            ?>
                    <div class="col-4">
                        <div class="p-relative">
                            <a href="?control=detail&id=<?php echo $lastProduct['product_id'] ?>">
                                <img src="images/<?php echo $lastProduct['product_image']; ?>">
                            </a>
                            <form action="?control=cart" method="POST">
                                <div class="block-addtocart-overlay">
                                    <div class="block-addtocart">
                                        <input type="hidden" name="productName" value="<?php echo $lastProduct['product_name'] ?>" />
                                        <input type="hidden" name="productID" value="<?php echo $lastProduct['product_id'] ?>" />
                                        <input type="hidden" name="productPrice" value="<?php echo $lastProduct['product_price'] ?>" />
                                        <input type="hidden" name="productIMG" value="<?php echo $lastProduct['product_image'] ?>" />
                                        <input type="hidden" name="productQty" value="1" />
                                        <button class="but-addtocart fs15 hov1" type="submit" onclick="pop_up()"> ADD TO CART </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="pdt-10">
                            <a href="?control=detail&id=<?php echo $lastProduct['product_id'] ?>">
                                <h4 class="h4_product"><?php echo $lastProduct['product_name']; ?></h4>
                            </a>
                            <p><?php echo '$' . number_format($lastProduct['product_price'], 2); ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </form>

</div>

<!----offer---->
<div class="offer">
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <img src="images/ap1.png" class="offer-img">
                <div class="sale-time">
                    <h1>Big Sale Time</h1>
                    <div class="saletime-box flex-co">
                        <span class="saletime-text" id="days">00</span>
                        <span class="saletime-text t-color">days</span>
                    </div>
                    <div class="saletime-box flex-co">
                        <span class="saletime-text" id="hours">00</span>
                        <span class="saletime-text t-color">hrs</span>
                    </div>
                    <div class="saletime-box flex-co">
                        <span class="saletime-text" id="minutes">00</span>
                        <span class="saletime-text t-color">mins</span>
                    </div>
                    <div class="saletime-box flex-co">
                        <span class="saletime-text" id="seconds">00</span>
                        <span class="saletime-text t-color">secs</span>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <p>Exclusive Available on Graceful</p>
                <h1>Apple Watch Series 7</h1>
                <small>
                    <!-- Doan nay chinh lai gioi thieu san pham -->
                    The larger display enhances the entire experience,
                    making Apple Watch easier to use and read.
                    Series 7 represents our biggest and brightest thinking yet.
                    Big screen, Huge impact.
                    The challenge was to create a bigger display while barely expanding the dimensions of the watch itself. To do so, the display was completely re‑engineered reducing the borders by 40%,
                    allowing for more screen area than both Series 6 and Series 3.<br>
                </small>
                <a href="products-detail4.html" class="btn">Buy Now &#8594;</a>
            </div>
        </div>
    </div>
</div>
<!----testimonial---->
<div class="testimonial">
    <div class="row">
        <div class="col-3">
            <i class="fa fa-quote-left"></i>
            <!-- Doan nay chinh lai review -->
            <p>
                fast delivery, friendly, good packaging
            </p>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <img src="images/phat.jpg">
            <h3>Phát Trương</h3>
        </div>
        <div class="col-3">
            <i class="fa fa-quote-left"></i>
            <!-- Doan nay chinh lai review -->
            <p>
                Excellent product quality, value for money,
                fast delivery, extremely enthusiastic consultants
            </p>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <img src="images/kiet.jpg">
            <h3>Kiệt Phan</h3>
        </div>
        <div class="col-3">
            <i class="fa fa-quote-left"></i>
            <!-- Doan nay chinh lai review -->
            <p>
                The quality of the shop's products is known to everyone,
                always perfect, the consultant is also extremely enthusiastic,
                and the delivery is extremely fast, will support the shop again in the near future
            </p>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <img src="images/nghia.jpg">
            <h3>Nghĩa Trần</h3>
        </div>
    </div>
</div>

<!----brands---->
<div class="brands">
    <div class="small-container">
        <div class="row">
            <div class="col-5">
                <img src="images/logo-godrej.png">
            </div>
            <div class="col-5">
                <img src="images/logo-oppo.png">
            </div>
            <div class="col-5">
                <img src="images/logo-coca-cola.png">
            </div>
            <div class="col-5">
                <img src="images/logo-paypal.png">
            </div>
            <div class="col-5">
                <img src="images/logo-philips.png">
            </div>
        </div>
    </div>
</div>

<script>
    function pop_up() {
        const el = document.createElement('div');
        el.innerHTML += "<a class='a-swal' href='?control=category&id=all'>Continue Shopping</a>";
        el.innerHTML += "<a class='a-swal' href='?control=cart'>View Cart</a>";
        swal({
            title: "Added!",
            content: el,
            button: false,
            icon: "success",
            // closeOnEsc: false,
            // closeOnClickOutside: false,
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').on("submit", function(event) {
            var formID = $(this).attr('id');
            if (formID != 'searchForm') {
                var url = $(this).attr('action');
                var data = $(this).serialize();
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function() {
                        //   alert('form was submitted');
                    },
                    error: function(data) {
                        alert('wrong');
                    }
                });
            }
        });
    });
</script>

<script>
    runClock();
    setInterval("runClock()", 1000);

    function runClock() {
        var currentDay = new Date();
        var exDate = new Date("May 30, 2022");
        var daysLeft = (exDate - currentDay) / (1000 * 60 * 60 * 24);

        var hrsLeft = (daysLeft - Math.floor(daysLeft)) * 24;
        var minsLeft = (hrsLeft - Math.floor(hrsLeft)) * 60;
        var secsLeft = (minsLeft - Math.floor(minsLeft)) * 60;
        document.getElementById("days").textContent = Math.floor(daysLeft);
        document.getElementById("hours").textContent = Math.floor(hrsLeft);
        document.getElementById("minutes").textContent = Math.floor(minsLeft);
        document.getElementById("seconds").textContent = Math.floor(secsLeft);

    }
</script>