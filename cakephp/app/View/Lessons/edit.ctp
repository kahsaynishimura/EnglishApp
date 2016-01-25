<div class="lessons form">
    <?php echo $this->Form->create('Lesson'); ?>
    <fieldset>
        <legend><?php echo __('Edit Lesson'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lesson.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Lesson.id')))); ?></li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index', $this->Form->value('Lesson.id'))); ?> </li>
    </ul>
</div>
