<div class="videoLessonScripts form">
    <?php echo $this->Form->create('VideoLessonScript'); ?>
    <fieldset>
        <legend><?php echo __('Add Video Lesson Script'); ?></legend>
        <?php
        echo $this->Form->input('text_to_show');
        echo $this->Form->input('text_to_check');
        echo $videoLesson['Lesson']['name'];
        echo __('Stop should be greater than start');
        echo $this->Form->input('start_minutes', array('label' => 'Start Minute', 'type' => 'number', 'min' => '0'));
        echo $this->Form->input('start_seconds', array('label' => 'Start Second', 'type' => 'number', 'min' => '0', 'max' => '60'));
        echo $this->Form->input('stop_minutes', array('label' => 'Stop Minute', 'type' => 'number', 'min' => '0'));
        echo $this->Form->input('stop_seconds', array('label' => 'Stop Second', 'type' => 'number', 'min' => '0', 'max' => '60'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Video Scripts'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
    </ul>
</div>
