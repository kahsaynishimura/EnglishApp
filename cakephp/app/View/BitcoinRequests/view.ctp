<div class="bitcoinRequests view">
<h2><?php echo __('Bitcoin Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bitcoinRequest['BitcoinRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Wallet'); ?></dt>
		<dd>
			<?php echo h($bitcoinRequest['BitcoinRequest']['wallet']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Btc'); ?></dt>
		<dd>
			<?php echo h($bitcoinRequest['BitcoinRequest']['total_btc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($bitcoinRequest['BitcoinRequest']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bitcoin Request'), array('action' => 'edit', $bitcoinRequest['BitcoinRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bitcoin Request'), array('action' => 'delete', $bitcoinRequest['BitcoinRequest']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $bitcoinRequest['BitcoinRequest']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Bitcoin Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bitcoin Request'), array('action' => 'add')); ?> </li>
	</ul>
</div>
