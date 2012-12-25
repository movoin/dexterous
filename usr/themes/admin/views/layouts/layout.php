<?php
/**
 * 默认布局
 *
 * @category theme
 * @package default
 * @copyright Copyright (c) 2012 Movoin Studio. (http://www.movoin.com)
 * @license http://www.gnu.org/licenses/gpl2.html GPL2.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
<?php $this->widget('head') ?>
  </head>
  <body class="<?php echo $this->bodyClass ?>">
    <?php $this->afterBodyStart() ?>

    <!-- Header Begin -->
    <?php $this->widget('header') ?>
    <!-- Header End -->

    <!-- Content Begin -->
    <?php echo $content ?>
    <!-- Content End -->

    <!-- Footer Begin -->
    <?php $this->widget('footer') ?>
    <!-- Footer End -->

    <?php $this->beforeBodyEnd() ?>
  </body>
</html>
