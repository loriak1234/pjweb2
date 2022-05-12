<?php
include("../db/connect.php");

if (isset($_GET['manage'])) {
    $temp = $_GET['manage'];
}

if (isset($_POST['pageNumber'])) {
    $getPage = $_POST['pageNumber'];
}

if (isset($_POST['currentPage'])) {
    $currentPage = $_POST['currentPage'];
}

if (isset($_POST['productPerPage'])) {
    $productPerPage = $_POST['productPerPage'];
}

if (isset($_POST['count'])) {
    $getCount = $_POST['count'];
}

if ($temp == 'delete') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql_delete = mysqli_query($conn, "DELETE FROM product WHERE product_id='$id'");
        $sql_detelePhotoDetail = mysqli_query($conn, "DELETE FROM image_detail WHERE product_id='$id'");
        $calculate = $getCount % $productPerPage;
        if ($calculate == 1 && $getPage == $currentPage) {
            header('location:product.php?page=' . $getPage - 1);
        } else header('location:product.php?page=' . $currentPage);
    }
} elseif (
    $temp == 'add' &&
    isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productQTY'])
    && isset($_POST['productMate']) && isset($_POST['productDes']) && isset($_POST['pageNumber'])
) {
    $sql_resetAI = mysqli_query($conn, "ALTER TABLE product AUTO_INCREMENT = 0");

    $tmp_name =  $_FILES["coverPhoto"]["tmp_name"];
    $fldimageurl = "../images/" . $_FILES["coverPhoto"]["name"];
    $cate = $_POST['category'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $qty = $_POST['productQTY'];
    $material = $_POST['productMate'];
    $description = $_POST['productDes'];
    $image = $_FILES["coverPhoto"]["name"];

    $filetype = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $filesize = $_FILES['coverPhoto']['size'];

    $alert = '';
    if ($filetype != 'jpg' && $filetype != "png" && $filetype != "jpeg") {
        $alert = "Incorrect File";
    } else {
        if ($filesize > 2000000) {
            $alert = "File must less than 2MB in size";
        } else {
            move_uploaded_file($tmp_name, $fldimageurl);
            $sql_add = mysqli_query($conn, "INSERT INTO product(category_id,product_name,product_price, product_quantity, product_image, product_material, product_active, product_description) 
        values ('$cate','$name','$price','$qty','$image','$material', '1', '$description')");

            if ($sql_add) {
                $sql_detailPhoto = mysqli_query($conn, 'SELECT * FROM product ORDER BY product_id DESC LIMIT 1');
                $row_detailPhoto = mysqli_fetch_array($sql_detailPhoto);
                $product_id = $row_detailPhoto['product_id'];
                $filename = $_FILES['detailPhoto']['name'];
                $filetmp =  $_FILES["detailPhoto"]["tmp_name"];

                if (isset($_POST['detailPhoto'])) {
                    foreach ($filename as $key => $value) {
                        move_uploaded_file($tmp_name[$key], "../images" . $value);
                        $sql = mysqli_query($conn, "INSERT INTO image_detail (product_id, img_detail) VALUES ('$product_id', '$value')");
                    }
                }
                $calculate = $getCount % $productPerPage;


                if ($calculate == 0) {
                    // header('location:product.php?&page=' . $getPage + 1);
?>
                    <script type="text/javascript">
                        var getPage = "<?php echo $getPage + 1; ?>";
                        alert('Add Successfully');
                        window.location.replace("product.php?&page=" + getPage);
                    </script>
                <?php
                } else {
                ?>
                    <script type="text/javascript">
                        var getPage = "<?php echo $getPage; ?>";
                        alert('Add Successfully');
                        window.location.replace("product.php?&page=" + getPage);
                    </script>
        <?php
                }
            }
        }
    }
} elseif (
    $temp == 'update' &&
    isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productQTY'])
    && isset($_POST['productMate']) && isset($_POST['productDes']) && isset($_POST['pageNumber']) 
    && isset($_POST['productActive'])
) {
    $tmp_name =  $_FILES["coverPhoto"]["tmp_name"];
    $fldimageurl = "../images/" . $_FILES["coverPhoto"]["name"];
    move_uploaded_file($tmp_name, $fldimageurl);
    $cate = $_POST['category'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $qty = $_POST['productQTY'];
    $material = $_POST['productMate'];
    $description = $_POST['productDes'];
    $id = $_POST['productID'];
    $active = $_POST['productActive'];
    $image = $_FILES["coverPhoto"]["name"];

    if ($image == '') {
        $sql_update = mysqli_query($conn, "UPDATE product SET category_id = '$cate', product_name = '$name', 
    product_price = '$price', product_quantity = '$qty', product_material = '$material', 
    product_active = '$active', product_description = '$description' WHERE product_id = '$id'");
    } else {
        $sql_update = mysqli_query($conn, "UPDATE product SET category_id = '$cate', product_name = '$name', 
    product_price = '$price', product_quantity = '$qty', product_material = '$material', 
    product_active = '$active', product_description = '$description', product_image = '$image' WHERE product_id = '$id'");
    }
    
    if ($sql_update) {
        $sql_detailPhoto = mysqli_query($conn, 'SELECT * FROM product ORDER BY product_id DESC LIMIT 1');
        $row_detailPhoto = mysqli_fetch_array($sql_detailPhoto);
        $product_id = $row_detailPhoto['product_id'];
        $filename = $_FILES['detailPhoto']['name'];
        $filetmp =  $_FILES["detailPhoto"]["tmp_name"];

        if (isset($_POST['detailPhoto'])) {
            foreach ($filename as $key => $value) {
                move_uploaded_file($tmp_name[$key], "../images" . $value);
                $sql = mysqli_query($conn, "UPDATE image_detail SET img_detail = '$value'");
            }
        }
        ?>
        <script type="text/javascript">
            var currentPage = "<?php echo $currentPage;?>";
            alert('Update Successfully');
            window.location.replace("product.php?&page=" + currentPage);
        </script>
<?php
    }
}
?>

<?php
include("include/head.php");
?>

<body>
    <style>
        .form-control {
            width: 80% !important;
        }

        .field-img {
            opacity: 0;
            position: absolute;
            height: 1px;
            width: 1px !important;
            padding: 0;
            float: left;
            border: none;
            margin-left: 50px;
            margin-top: -10px;
        }
    </style>
    <?php
    include('header.php');
    ?>

    <?php
    if ($temp == 'add') {
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group row p-t-15">
                <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select name="category" class="form-control" required>
                        <option value="">----- Category -----</option>
                        <?php
                        $sql_category = mysqli_query($conn, 'SELECT * FROM category');
                        while ($row_cateProduct = mysqli_fetch_array($sql_category)) {
                        ?>
                            <option value="<?php echo $row_cateProduct['category_id'] ?>"><?php echo $row_cateProduct['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPDN" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="productName" class="form-control" placeholder="Product name" id="inputPDN" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPDP" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="productPrice" class="form-control" placeholder="Product price" id="inputPDP" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputQTY" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input type="number" name="productQTY" class="form-control" placeholder="Product quantity" id="inputQTY" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputMate" class="col-sm-2 col-form-label">Material</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="productMate" placeholder="Product material" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputDes" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="productDes" required></textarea>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Cover Photo </label>
                <div class="col-sm-10">
                    <span style="color:red">
                        <?php if (isset($alert)) {
                            echo $alert;
                        }
                        ?>
                    </span>
                    <label style="height: auto;" for="inputCover" class="form-control label-img">

                        <span> <i class="fa fa-cloud-upload"></i> Upload</span>
                        <div style="display:inline" id="change_div">Upload your image</div>
                    </label>

                    <input type="file" name="coverPhoto" class="form-control field-img" id="inputCover" accept="image/*" onchange="call_change()" required>


                    <img style="width: 50%;" id="output_image" />
                    <?php
                    ?>
                </div>
            </div>

            <input type="hidden" name="pageNumber" value="<?php echo $getPage ?>">
            <input type="hidden" name="count" value="<?php echo $getCount ?>">
            <input type="hidden" name="productPerPage" value="<?php echo $productPerPage ?>">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Detail Photos</label>
                <div class="col-sm-10">
                    <label style="height: auto;" for="inputDetail" class="form-control label-img">
                        <span> <i class="fa fa-cloud-upload"></i> Upload</span>
                        <div style="display:inline" id="change_text2">Choose your images</div>
                    </label>

                    <input multiple type="file" name="detailPhoto[]" class="form-control field-img" id="inputDetail" accept="image/*" onchange="test()">
                    <button style="margin-top:15px;" type="submit" name="addProduct" class="btn btn-info">Add new product</button>
                </div>
            </div>

        </form>
    <?php
    } else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql_updateProduct = mysqli_query($conn, "SELECT * FROM product WHERE product_id = $id");
            $row_updateProduct = mysqli_fetch_array($sql_updateProduct);

            $sql_productCate = mysqli_query($conn, "SELECT * FROM product, category 
            WHERE product.category_id = category.category_id AND product_id = '$id'");
            $row_productCate = mysqli_fetch_array($sql_productCate);

            $sql_countPhoto = mysqli_query($conn, "SELECT COUNT(*) AS countPhoto FROM image_detail
            WHERE product_id = $id");
            $countPhoto = mysqli_fetch_array($sql_countPhoto);
        }
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="productID" value="<?php echo $id ?>">
            <input type="hidden" name="currentPage" value="<?php echo $currentPage?>">
            <div class="form-group row p-t-15">
                <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select name="category" class="form-control" required>
                        <option value="">----- Category -----</option>
                        <?php
                        $sql_category = mysqli_query($conn, 'SELECT * FROM category');
                        while ($row_cateProduct = mysqli_fetch_array($sql_category)) {
                            if ($row_cateProduct['category_id'] == $row_productCate['category_id']) {
                        ?>
                                <option selected value="<?php echo $row_cateProduct['category_id'] ?>"><?php echo $row_cateProduct['category_name'] ?></option>
                            <?php
                            } else {
                            ?>
                                <option value="<?php echo $row_cateProduct['category_id'] ?>"><?php echo $row_cateProduct['category_name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPDN" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" name="productName" class="form-control" placeholder="Product name" id="inputPDN" required value="<?php echo $row_updateProduct['product_name']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPDP" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" name="productPrice" class="form-control" placeholder="Product price" id="inputPDP" required value="<?php echo $row_updateProduct['product_price']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputQTY" class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                    <input type="number" name="productQTY" class="form-control" placeholder="Product quantity" id="inputQTY" required value="<?php echo $row_updateProduct['product_quantity']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputMate" class="col-sm-2 col-form-label">Material</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="productMate" placeholder="Product material" value="<?php echo $row_updateProduct['product_material']; ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputMate" class="col-sm-2 col-form-label">Active</label>
                <div class="col-sm-10">
                    <select name="productActive" class="form-control" required>
                        <option value="">----- Active -----</option>
                        <?php
                            if ($row_updateProduct['product_active'] == 1) {
                        ?>
                                <option value="0">0 - Not Active</option>
                                <option value="1" selected>1 - Active</option>
                            <?php
                            } else {
                            ?>
                                <option value="0" selected>0 - Not Active</option>
                                <option value="1">1 - Active</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputDes" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="productDes"><?php echo $row_updateProduct['product_description']; ?></textarea required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"> Cover Photo </label>
                <div class="col-sm-10">
                    <label style="height: auto;" for="inputCover" class="form-control label-img">
                        <span> <i class="fa fa-cloud-upload"></i> Upload</span>
                        <div style="display:inline" id="change_div"><?php echo $row_updateProduct['product_image']; ?></div>
                    </label>

                    <input type="file" name="coverPhoto" class="form-control field-img" id="inputCover" accept="image/*" onchange="call_change()">
                    <img style="width: 50%;" id="output_image" />
                    <?php
                    ?>
                </div>
            </div>

            <input type="hidden" name="pageNumber" value="<?php echo $getPage ?>">
            <input type="hidden" name="count" value="<?php echo $getCount ?>">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Detail Photos</label>
                <div class="col-sm-10">
                    <label style="height: auto;" for="inputDetail" class="form-control label-img">
                        <span> <i class="fa fa-cloud-upload"></i> Upload</span>
                        <div style="display:inline" id="change_text2">
                            <?php
                            if ($countPhoto['countPhoto'] > 0)
                                echo $countPhoto['countPhoto'] . " Files";
                            else echo 'Choose your images';
                            ?>
                        </div>
                    </label>

                    <input multiple type="file" name="detailPhoto[]" class="form-control field-img" id="inputDetail" accept="image/*" onchange="test()">
                    <button style="margin-top:15px;" type="submit" name="addProduct" class="btn btn-info">Update Product</button>
                </div>
            </div>

        </form>
    <?php
    }
    ?>
</body>

</html>