<?php
/**
 * 通栏布局
 *
 * @category theme
 * @package default
 * @copyright Copyright (c) 2012 Movoin Studio. (http://www.movoin.com)
 * @license http://www.gnu.org/licenses/gpl2.html GPL2.0
 */
?>
<?php $this->beginContent('/layouts/layout'); ?>
    <section class="warpper">
        <?php $this->widget('breadcrumbs') ?>
        <?php echo $content ?>
    </section>
<?php $this->endContent(); ?>
