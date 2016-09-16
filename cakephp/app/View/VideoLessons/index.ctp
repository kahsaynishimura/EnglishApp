<div class="videoLessons index">
    <h2><?php echo __('Video Lessons'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('id_video'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videoLessons as $videoLesson): ?>
                <tr>
                    <td><?php echo h($videoLesson['VideoLesson']['id']); ?>&nbsp;</td>
                    <td><?php echo h($videoLesson['VideoLesson']['name']); ?>&nbsp;</td> 
                    <td><?php echo h($videoLesson['VideoLesson']['id_video']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $videoLesson['VideoLesson']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $videoLesson['VideoLesson']['id'])); ?>
                        <?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index', $videoLesson['VideoLesson']['id'])); ?> 
                        <?php echo $this->Html->link(__('Add Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'add', $videoLesson['VideoLesson']['id'])); ?> 
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $videoLesson['VideoLesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $videoLesson['VideoLesson']['id']))); ?>
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
        <li><?php echo $this->Html->link(__('New Video Lesson'), array('action' => 'add')); ?></li>
    </ul>
</div>
