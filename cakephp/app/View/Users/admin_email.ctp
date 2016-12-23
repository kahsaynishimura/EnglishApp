<div class="users index">
    <h2><?php echo __('Not Brazilian Users'); ?></h2>
   
            <?php foreach ($users as $user): ?>
                <?php echo h($user['User']['username']).';'; ?>&nbsp;
                   
            <?php endforeach; ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
    </ul>
</div>
