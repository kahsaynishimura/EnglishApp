<div class="usersPackages view">
<h2><?php echo __('Users Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersPackage['UsersPackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersPackage['User']['name'], array('controller' => 'users', 'action' => 'view', $usersPackage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersPackage['Package']['name'], array('controller' => 'packages', 'action' => 'view', $usersPackage['Package']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($usersPackage['UsersPackage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($usersPackage['UsersPackage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Package'), array('action' => 'edit', $usersPackage['UsersPackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Package'), array('action' => 'delete', $usersPackage['UsersPackage']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersPackage['UsersPackage']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
