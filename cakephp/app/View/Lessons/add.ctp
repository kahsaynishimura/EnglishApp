<div class="lessons form">
    <?php echo $this->Form->create('Lesson'); ?>
    <fieldset>
        <legend><?php echo __('Add Lesson'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('id_video');
        echo $this->Form->input('start_of_video_sec', array('default' => 0, 'label' => __('Start of Video in seconds')));
        echo $this->Form->input('end_of_video_sec', array('default' => 0, 'label' => __('End of Video in seconds')));
        echo $this->Form->input('lesson_index');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Lessons'), array('action' => 'index', $this->request->params['pass'][0])); ?></li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
    </ul>
</div>
