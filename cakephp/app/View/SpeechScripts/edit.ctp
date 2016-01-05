<div class="speechScripts form">
<?php echo $this->Form->create('SpeechScript'); ?>
	<fieldset>
		<legend><?php echo __('Edit Speech Script'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text_to_read');
		echo $this->Form->input('text_to_check');
		echo $this->Form->input('text_to_show');
		echo $this->Form->input('speech_function_id');
		echo $this->Form->input('exercise_id');
		echo $this->Form->input('script_index');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SpeechScript.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('SpeechScript.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Speech Functions'), array('controller' => 'speech_functions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Function'), array('controller' => 'speech_functions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exercise'), array('controller' => 'exercises', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Scripts Users'), array('controller' => 'scripts_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scripts User'), array('controller' => 'scripts_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
