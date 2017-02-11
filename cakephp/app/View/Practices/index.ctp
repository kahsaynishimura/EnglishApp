<div class="practices index">
    <h2><?php echo __('Practices'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('exercise_id'); ?></th>
                <th><?php echo $this->Paginator->sort('Exercise.lesson_id'); ?></th>
                <th><?php echo $this->Paginator->sort('start_time'); ?></th>
                <th><?php echo $this->Paginator->sort('finish_time'); ?></th>
                <th><?php echo $this->Paginator->sort('points'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($practices as $practice): ?>
                <tr>
                    <td><?php echo h($practice['Practice']['id']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($practice['User']['name'], array('controller' => 'users', 'action' => 'view', $practice['User']['id'])); ?>
                    </td>
                    <td><?php echo h($practice['User']['id']); ?>&nbsp;</td>
                    <td><?php echo h($practice['Exercise']['name']); ?>&nbsp;</td>
                    <td><?php echo h($practice['Exercise']['Lesson']['name']); ?>&nbsp;</td>
                    <td><?php echo h($practice['Practice']['start_time']); ?>&nbsp;</td>
                    <td><?php echo h($practice['Practice']['finish_time']); ?>&nbsp;</td>
                    <td><?php echo h($practice['Practice']['points']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $practice['Practice']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $practice['Practice']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $practice['Practice']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $practice['Practice']['id']))); ?>
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
        <li><?php echo $this->Html->link(__('New Practice'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
    </ul>
</div>
