<div class="trades view">
<h2><?php echo __('Trade'); ?></h2>
	<dl>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($trade['Product']['name'], array('controller' => 'products', 'action' => 'view', $trade['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($trade['User']['name'], array('controller' => 'users', 'action' => 'view', $trade['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qr Code'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['qr_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Validated'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['validated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($trade['Trade']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Trade'), array('action' => 'edit', $trade['Trade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Trade'), array('action' => 'delete', $trade['Trade']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $trade['Trade']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Trades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Trade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
