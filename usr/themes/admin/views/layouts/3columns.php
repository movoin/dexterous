<?php
/**
 * 三栏布局
 *
 * @category theme
 * @package default
 * @copyright Copyright (c) 2012 Movoin Studio. (http://www.movoin.com)
 * @license http://www.gnu.org/licenses/gpl2.html GPL2.0
 */
?>
<?php $this->beginContent('/layouts/layout'); ?>
    <section class="warpper 3cols">
        <side>
            <?php $this->widget('sidebar', array('position' => 'left')) ?>
        </side>
        <section>
            <?php $this->widget('breadcrumbs') ?>
            <?php echo $content ?>
        </section>
        <side>
            <?php $this->widget('sidebar', array('position' => 'right')) ?>
        </side>
        <div class="clearfix"></div>
    </section>
<?php $this->endContent(); ?>
