<?php
$stringURL = basename($_SERVER['REQUEST_URI'], ".php");
if($stringURL == 'admin'){
    $stringURL = 'Home';
}
elseif($stringURL == 'category'){
    $stringURL = 'Categories';
}
elseif($stringURL =='addCategory'){
    $stringURL = 'Add New Category';
}
elseif($stringURL =='product' || strpos($stringURL,"page"))
{
    $stringURL = 'Products';
}
elseif(strpos($stringURL,"?update"))
{
    $stringURL = 'Update Category';
}
elseif(strpos($stringURL,"manage=add"))
{
    $stringURL = 'Add Product';
}
elseif(strpos($stringURL,"manage=update"))
{
    $stringURL = 'Update Product';
}

?>

