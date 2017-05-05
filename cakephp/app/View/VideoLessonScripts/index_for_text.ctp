<div class="videoLessonScripts index">
    <h2><?php echo __('Video Lesson Scripts'); ?></h2>
    <?php foreach ($videoLessonScripts as $videoLessonScript): ?>

        <p>

            <?php echo h($videoLessonScript['VideoLessonScript']['text_to_show']); ?>
        </p>
    <?php endforeach; ?>
</div>
<div class = "actions">
    <h3><?php echo __('Actions');
    ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Text Practice'), array('controller' => 'books', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
    </ul>
</div>
