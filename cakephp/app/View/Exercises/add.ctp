<div class="exercises form">
<?php echo $this->Form->create('Exercise'); ?>
	<fieldset>
		<legend><?php echo __('Add Exercise'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('lesson_id');
		echo $this->Form->input('transition_image');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Exercises'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Speech Scripts'), array('controller' => 'speech_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Speech Script'), array('controller' => 'speech_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
