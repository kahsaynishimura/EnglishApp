<div class="books form">
    <?php echo $this->Form->create('Book'); ?>
    <fieldset>
        <legend><?php echo __('Add Book'); ?></legend>
        <?php echo $this->Form->input('name'); ?>
        <?php echo $this->Form->input('package_id'); ?>

        <?php
        echo $this->Form->input('is_free', array('label' => 'Free'));
        echo $this->Form->input('difficulty_level', array(
            'options' => array('1' => __('easy'), '2' => __('normal'), '3' => __('hard'))
        ));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Books'), array('action' => 'index')); ?></li>
    </ul>
</div>
