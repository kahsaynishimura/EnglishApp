<div class="lessons index">
    <h2><?php echo __('Lessons'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('id_video'); ?></th>
                <th><?php echo $this->Paginator->sort('start_of_video_sec'); ?></th>
                <th><?php echo $this->Paginator->sort('end_of_video_sec'); ?></th>
                <th><?php echo $this->Paginator->sort('lesson_index'); ?></th>
                <th><?php echo $this->Paginator->sort('book_id'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?php echo h($lesson['Lesson']['id']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['name']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['id_video']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['start_of_video_sec']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['end_of_video_sec']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['lesson_index']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($lesson['Book']['name'], array('controller' => 'books', 'action' => 'view', $lesson['Book']['id'])); ?>
                    </td>
                    <td><?php echo h($lesson['Lesson']['created']); ?>&nbsp;</td>
                    <td><?php echo h($lesson['Lesson']['modified']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php if (empty($lesson['Lesson']['id_video']) && empty($lesson['Lesson']['url_pdf'])): ?>
                            <?php echo $this->Html->link(__('Add Practices'), array('controller' => 'speech_scripts', 'action' => 'add', $lesson['Lesson']['id'])); ?>
                            <?php echo $this->Html->link(__('List Exercises'), array('controller' => 'exercises', 'action' => 'index', $lesson['Lesson']['id'])); ?>
                        <?php elseif (!empty($lesson['Lesson']['id_video'])): ?>
                            <?php echo $this->Html->link(__('List Video Lesson Scripts'), array('controller' => 'video_lesson_scripts', 'action' => 'index', $lesson['Lesson']['id'])); ?> 
                            <?php echo $this->Html->link(__('Get Text Practices from video'), array('controller' => 'video_lesson_scripts', 'action' => 'index_for_text', $lesson['Lesson']['id'])); ?> 
                        <?php elseif (!empty($lesson['Lesson']['url_pdf'])): ?> 
                            <?php echo $this->Html->link(__('View Workbook'), $lesson['Lesson']['url_pdf'], array('target' => '_blank')); ?> 
                        <?php endif; ?>
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $lesson['Lesson']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lesson['Lesson']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lesson['Lesson']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $lesson['Lesson']['id']))); ?>
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
        <li><?php echo $this->Html->link(__('New Lesson'), array('action' => 'add', $this->request->params['pass'][0])); ?></li>
        <li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
    </ul>
</div>
