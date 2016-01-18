<div class="usersBooks form">
    <?php echo $this->Form->create('UsersBook'); ?>
    <fieldset>
        <legend><?php echo __('Unlock book to:'); ?></legend>
        <?php
        echo $this->Form->input('email');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?></li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related Users'); ?></h3>
    <?php if (!empty($usersBooks)): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($usersBooks as $user): ?>
                <tr>
                    <td><?php echo $user['User']['id']; ?></td>
                    <td><?php echo $user['User']['name']; ?></td>
                    <td><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users_books', 'action' => 'delete', $user['Book']['id'], $user['UsersBook']['id']), array('confirm' => __('Are you sure you want to remove the access for this user?'))); ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>


</div>