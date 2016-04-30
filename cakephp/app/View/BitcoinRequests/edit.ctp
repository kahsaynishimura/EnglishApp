<div class="bitcoinRequests form">
<?php echo $this->Form->create('BitcoinRequest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bitcoin Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('wallet');
		echo $this->Form->input('total_btc');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BitcoinRequest.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('BitcoinRequest.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Bitcoin Requests'), array('action' => 'index')); ?></li>
	</ul>
</div>