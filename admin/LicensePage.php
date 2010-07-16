<?php
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

?>

<div class="wrap">
  <h2><?php echo "JW Player Licensing"; ?></h2>
  <form name="<?php echo LONGTAIL_KEY . "form"; ?>" method="post" action="">
    <p/>
    <div>
      <input type="submit" name="License" class="button-secondary action" value="Click Here to Purchase a License"/>
      <p><?php echo "By default, this plugin uses the latest non-commercial version of the JW Player.  Use of the player, skins and plugins is free for non-commercial use.  If you operate a commercial site (i.e., sells products, runs ads, or is owned by a company), you are required to purchase a license for the products you use." ?></p>
      <p><?php echo "Purchasing a license will remove the JW Player watermark and allow you to set your own watermark if desired.  In addition, you will be able to use commercial-only plugins, such as advertising plugins."; ?></p>
      <p><?php echo "Once you have purchased a license for the commercial player, you can upload it here."; ?></p>
    </div>
  </form>
</div>
