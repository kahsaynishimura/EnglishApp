<div class="bitcoinRequests index">
	<h2><?php echo __('Bitcoin Requests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('wallet'); ?></th>
			<th><?php echo $this->Paginator->sort('total_btc'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($bitcoinRequests as $bitcoinRequest): ?>
	<tr>
            
		<td><?php echo h($bitcoinRequest['BitcoinRequest']['id']); ?>&nbsp;</td>
		<td><?php echo h($bitcoinRequest['BitcoinRequest']['wallet']); ?>&nbsp;</td>
		<td><?php echo h($bitcoinRequest['BitcoinRequest']['total_btc']); ?>&nbsp;</td>
		<td><?php echo h($bitcoinRequest['BitcoinRequest']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bitcoinRequest['BitcoinRequest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bitcoinRequest['BitcoinRequest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bitcoinRequest['BitcoinRequest']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $bitcoinRequest['BitcoinRequest']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Bitcoin Request'), array('action' => 'add')); ?></li>
	</ul>
</div>
