<?= Form::open('crawler/crawl') ?>

<?= Form::input('url', null, array('type' => 'text')); ?>
<?= Form::button('save', 'Start crawl', array('type' => 'submit')); ?>

<?= Form::close() ?>
