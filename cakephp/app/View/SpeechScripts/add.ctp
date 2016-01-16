<div class="speechScripts form">
<?php echo $this->Form->create('SpeechScript'); ?>
	<fieldset>
		<legend><?php echo __('Add Speech Script'); ?></legend>
	<?php
        
		echo $this->Form->input('exercise_id');
		echo $this->Form->input('complete_text',array('type'=>'textarea','label'=>__('Type the complete text for a single exercise separating the practices by line break:')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Speech Functions'), array('controller' => 'speech_functions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Function'), array('controller' => 'speech_functions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exercise'), array('controller' => 'exercises', 'action' => 'add')); ?> </li>
	</ul>
</div>
