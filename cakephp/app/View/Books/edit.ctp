<div class="books form">
<?php echo $this->Form->create('Book'); ?>
	<fieldset>
		<legend><?php echo __('Edit Book'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name'); 
                 echo $this->Form->input('is_free',array('label'=>__('Free'))); echo $this->Form->input('difficulty_level', array(
            'options' => array('1' => __('easy'),'2'=>__('normal'),'3'=>__('hard'))
        ));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Book.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Book.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Books'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index',$this->Form->value('Book.id'))); ?> </li>
	</ul>
</div>
