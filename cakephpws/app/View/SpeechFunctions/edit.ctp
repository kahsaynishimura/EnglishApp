<div class="speechFunctions form">
<?php echo $this->Form->create('SpeechFunction'); ?>
	<fieldset>
		<legend><?php echo __('Edit Speech Function'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SpeechFunction.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('SpeechFunction.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Speech Functions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
