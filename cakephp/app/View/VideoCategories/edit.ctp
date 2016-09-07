<div class="videoCategories form">
<?php echo $this->Form->create('VideoCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Video Category'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VideoCategory.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('VideoCategory.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Video Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
	</ul>
</div>
