<div class="usersPackages form">
<?php echo $this->Form->create('UsersPackage'); ?>
	<fieldset>
		<legend><?php echo __('Add Users Package'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('package_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users Packages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
