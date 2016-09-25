<div class="videoLessonScriptChecks form">
<?php echo $this->Form->create('VideoLessonScriptCheck'); ?>
	<fieldset>
		<legend><?php echo __('Add Video Lesson Script Check'); ?></legend>
	<?php
		echo $this->Form->input('text_to_check');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Video Lesson Script Checks'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson Script'), array('controller' => 'video_lesson_scripts', 'action' => 'add')); ?> </li>
	</ul>
</div>
