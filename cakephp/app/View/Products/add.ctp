<div class="products form">
    <?php echo $this->Form->create('Product'); ?>
    <fieldset>
        <legend><?php echo __('Add Product'); ?></legend>
        <?php
        echo $this->Form->input('partner_id');
        echo $this->Form->input('name');
        echo $this->Form->input('description');
        echo $this->Form->input('quantity_available');
        echo $this->Form->input('points_value');
        echo $this->Form->input('payment_status');
        echo $this->Form->input('thumb');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Partners'), array('controller' => 'partners', 'action' => 'index')); ?> </li>
    </ul>
</div>
