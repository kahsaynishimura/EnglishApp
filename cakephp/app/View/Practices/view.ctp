<div class="practices view">
<h2><?php echo __('Practice'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($practice['User']['name'], array('controller' => 'users', 'action' => 'view', $practice['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['start_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish Time'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['finish_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Points'); ?></dt>
		<dd>
			<?php echo h($practice['Practice']['points']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Practice'), array('action' => 'edit', $practice['Practice']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Practice'), array('action' => 'delete', $practice['Practice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $practice['Practice']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Practices'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Practice'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
