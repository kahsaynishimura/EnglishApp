<div class="practices form">
<?php echo $this->Form->create('Practice'); ?>
	<fieldset>
		<legend><?php echo __('Add Practice'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('start_time');
		echo $this->Form->input('finish_time');
		echo $this->Form->input('points');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Practices'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
