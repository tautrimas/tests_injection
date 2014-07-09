<?php echo View::factory('menu'); ?>
<?php echo Form::open('crawler/crawl') ?>

<?php echo Form::input('url', null, array('type' => 'text')); ?>
<?php echo Form::button('save', 'Start crawl', array('type' => 'submit')); ?>

<?php echo Form::close() ?>
