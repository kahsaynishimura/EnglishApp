<div class="videoLessons form">
    <?php echo $this->Form->create('VideoLesson'); ?>
    <fieldset>
        <legend><?php echo __('Edit Video Lesson'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('id_video');
        echo $this->Form->input('video_category_id', array(
            'options' => $categories
        ));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VideoLesson.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('VideoLesson.id')))); ?></li>
        <li><?php echo $this->Html->link(__('List Video Lessons'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
    </ul>
</div>