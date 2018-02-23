<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Price'), ['action' => 'edit', $price->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Price'), ['action' => 'delete', $price->id], ['confirm' => __('Are you sure you want to delete # {0}?', $price->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Prices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Matrixtables'), ['controller' => 'Matrixtables', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Matrixtable'), ['controller' => 'Matrixtables', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="prices view large-9 medium-8 columns content">
    <h3><?= h($price->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Matrixtable') ?></th>
            <td><?= $price->has('matrixtable') ? $this->Html->link($price->matrixtable->name, ['controller' => 'Matrixtables', 'action' => 'view', $price->matrixtable->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $price->has('user') ? $this->Html->link($price->user->username, ['controller' => 'Users', 'action' => 'view', $price->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($price->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('PricePerMesure') ?></h4>
        <?= $this->Text->autoParagraph(h($price->pricePerMesure)); ?>
    </div>
</div>
