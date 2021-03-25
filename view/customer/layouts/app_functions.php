<?php 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(!isset($_SESSION['login_type'])){
    header("location:".BASE_URL.'view/customer/');   
}
function topbar_icon_list()
{
    global $app_version;
    ?>
   
    <li>
        <a class="btn app_btn_out" data-toggle="tooltip" data-placement="bottom" title="Sign Out" href="<?php echo BASE_URL ?>view/customer/index.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span class="hidden visible-xs">&nbsp;&nbsp;Sign Out</span></a>    
    </li> 
    <?php
}
?>