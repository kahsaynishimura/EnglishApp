<div class="packages form">
    <?php echo $this->Form->create('Package'); ?>
    <fieldset>
        <legend><?php echo __('Add Package'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('is_free');
        echo $this->Form->input('is_scratch');
        echo $this->Form->input('description');
        echo $this->Form->input('locale');
        echo $this->Form->input('link_blog_description');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Packages'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add')); ?> </li>
    </ul>
</div>
