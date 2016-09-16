<div class="videoLessons form">
    <?php echo $this->Form->create('VideoLesson'); ?>
    <fieldset>
        <legend><?php echo __('Add Video Lesson'); ?></legend>
        <?php
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
        <li><?php echo $this->Html->link(__('List Video Lessons'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
    </ul>
</div>
