<div class="practices form">
<?php echo $this->Form->create('Practice'); ?>
	<fieldset>
		<legend><?php echo __('Edit Practice'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Practice.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Practice.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Practices'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
