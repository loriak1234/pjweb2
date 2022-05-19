<?php
$URL = pathinfo($_SERVER['REQUEST_URI']);
$stringURL = $URL['filename'];
$stringURLpos = basename($_SERVER['REQUEST_URI']);
// echo $stringURL;

if($stringURL == 'dashboard'){
    $stringURL = 'Home';
}
elseif($stringURL == 'category'){
    $stringURL = 'Categories';
}
elseif($stringURL == 'users'){
    $stringURL = 'Users';
}
elseif($stringURL =='addCategory'){
    $stringURL = 'Add New Category';
}
elseif($stringURL =='product')
{
    $stringURL = 'Products';
}
elseif($stringURL == 'updateCategory')
{
    $stringURL = 'Update Category';
}
elseif($stringURL == 'order')
{
    $stringURL = 'Orders';
}
elseif(strpos($stringURLpos,"manageUser=update")){
    $stringURL = 'Update User';
}
elseif(strpos($stringURLpos,"manageUser=add")){
    $stringURL = 'Add User';
}
elseif(strpos($stringURLpos,"manage=add"))
{
    $stringURL = 'Add Product';
}
elseif(strpos($stringURLpos,"manage=update"))
{
    $stringURL = 'Update Product';
}
elseif(strpos($stringURLpos,"code=")){
    $stringURL = 'Order Detail';
}


?>

