<div class="partners form">
    <?php echo $this->Form->create('Partner'); ?>
    <fieldset>
        <legend><?php echo __('Add Company'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('phone');
        echo $this->Form->input('address');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
    </ul>
</div>
