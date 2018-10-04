<div class="lessons view">
    <h2><?php echo __('Lesson'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Video Id'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['id_video']); ?>
            &nbsp;
        </dd> 
        <dt><?php echo __('Start milis'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['start_of_video_sec']); ?>
            &nbsp;
        </dd> 
        <dt><?php echo __('End milis'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['end_of_video_sec']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Book'); ?></dt>
        <dd>
            <?php echo $this->Html->link($lesson['Book']['name'], array('controller' => 'books', 'action' => 'view', $lesson['Book']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($lesson['Lesson']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Lesson'), array('action' => 'edit', $lesson['Lesson']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Lesson'), array('action' => 'delete', $lesson['Lesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $lesson['Lesson']['id']))); ?> </li>
        <li><?php echo $this->Html->link(__('List Lessons'), array('action' => 'index', $lesson['Book']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('New Lesson'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Related Exercises'); ?></h3>
    <?php if (!empty($lesson['Exercise'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Lesson Id'); ?></th>
                <th><?php echo __('Transition Image'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($lesson['Exercise'] as $exercise): ?>
                <tr>
                    <td><?php echo $exercise['id']; ?></td>
                    <td><?php echo $exercise['name']; ?></td>
                    <td><?php echo $exercise['lesson_id']; ?></td>
                    <td><?php echo $exercise['transition_image']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'exercises', 'action' => 'view', $exercise['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'exercises', 'action' => 'edit', $exercise['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'exercises', 'action' => 'delete', $exercise['id']), array('confirm' => __('Are you sure you want to delete # %s?', $exercise['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>
