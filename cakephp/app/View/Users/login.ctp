
<div class="users form">
    <?php echo $this->Flash->render('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php 
        echo $this->Form->input('username',array('label'=>'Email'));
        echo $this->Form->input('password'); 
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Criar conta'), array('action' => 'add')); ?></li>
    </ul>
</div>
 