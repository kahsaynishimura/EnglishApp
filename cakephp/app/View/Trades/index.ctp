<div class="trades index">
	<h2><?php echo __('Trades'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('qr_code'); ?></th>
			<th><?php echo $this->Paginator->sort('validated'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($trades as $trade): ?>
	<tr>
		<td><?php echo h($trade['Trade']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($trade['Product']['name'], array('controller' => 'products', 'action' => 'view', $trade['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($trade['User']['name'], array('controller' => 'users', 'action' => 'view', $trade['User']['id'])); ?>
		</td>
		<td><?php echo h($trade['Trade']['qr_code']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['validated']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['created']); ?>&nbsp;</td>
		<td><?php echo h($trade['Trade']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $trade['Trade']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $trade['Trade']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $trade['Trade']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $trade['Trade']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Trade'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
