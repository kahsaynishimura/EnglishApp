<div class="packages index">
    <h2><?php echo __('Packages'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr> 
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('description'); ?></th>
                <th><?php echo $this->Paginator->sort('link_blog_description'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($packages as $package): ?>
                <tr>
                    <td><?php echo h($package['Package']['id']); ?>&nbsp;</td>
                    <td><?php echo h($package['Package']['name']); ?>&nbsp;</td>
                    <td><?php echo h($package['Package']['description']); ?>&nbsp;</td>
                    <td><?php echo h($package['Package']['link_blog_description']); ?>&nbsp;</td>
                    <td><?php echo h($package['Package']['created']); ?>&nbsp;</td>
                    <td><?php echo h($package['Package']['modified']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Add Text Practice'), array('controller' => 'books', 'action' => 'add', $package['Package']['id'])); ?>
                        <?php echo $this->Html->link(__('Add Video Practice'), array('controller' => 'videoLessons', 'action' => 'add', $package['Package']['id'])); ?>
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $package['Package']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $package['Package']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $package['Package']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $package['Package']['id']))); ?>
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
        <li><?php echo $this->Html->link(__('New Package'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Video Lessons'), array('controller' => 'video_lessons', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Video Lesson'), array('controller' => 'video_lessons', 'action' => 'add')); ?> </li>
    </ul>
</div>
