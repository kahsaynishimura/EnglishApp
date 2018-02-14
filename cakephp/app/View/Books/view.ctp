<div class="books view">
    <h2><?php echo __('Book'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($book['Book']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($book['Book']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Author'); ?></dt>
        <dd>
            <?php echo h($book['Book']['user_id']); ?>
            &nbsp;
        </dd>
    </dl>
     <h3><?php echo __('Related Lessons'); ?></h3>

</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul> 
        <li><?php echo $this->Html->link(__('New Lesson'), array('controller' => 'lessons', 'action' => 'add', $book['Book']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Edit Book'), array('action' => 'edit', $book['Book']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Book'), array('action' => 'delete', $book['Book']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $book['Book']['id']))); ?> </li>
        <li><?php echo $this->Html->link(__('List Books'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Book'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Lessons'), array('controller' => 'lessons', 'action' => 'index', $book['Book']['id'])); ?> </li>
    </ul>
</div>
<div class="related">
   

    <?php echo $this->element('list_lessons'); ?>

</div>
