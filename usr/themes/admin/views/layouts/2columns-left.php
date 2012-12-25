<?php
/**
 * 两栏布局 - 左栏
 *
 * @category theme
 * @package default
 * @copyright Copyright (c) 2012 Movoin Studio. (http://www.movoin.com)
 * @license http://www.gnu.org/licenses/gpl2.html GPL2.0
 */
?>
<?php $this->beginContent('/layouts/layout'); ?>
    <section class="warpper 2cols-left">
        <side>
            <?php $this->widget('sidebar', array('position' => 'left')) ?>
        </side>
        <section>
            <?php $this->widget('breadcrumbs') ?>
            <?php echo $content ?>
        </section>
        <div class="clearfix"></div>
    </section>
<?php $this->endContent(); ?>
