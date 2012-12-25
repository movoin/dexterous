<?php
/**
 * 空布局, 只显示内容主体, 不显示头尾部分
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
  <body class="empty <?php echo $this->bodyClass ?>">
    <?php $this->afterBodyStart() ?>

    <!-- Content Begin -->
    <?php echo $content ?>
    <!-- Content End -->

    <?php $this->beforeBodyEnd() ?>
  </body>
</html>
