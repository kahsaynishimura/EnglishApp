<div class="scriptsUsers form">
<?php echo $this->Form->create('ScriptsUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Scripts User'); ?></legend>
	<?php
		echo $this->Form->input('start_time');
		echo $this->Form->input('finish_time');
		echo $this->Form->input('user_id');
		echo $this->Form->input('speech_script_id');
		echo $this->Form->input('number_attempts');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ScriptsUser.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('ScriptsUser.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Scripts Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
