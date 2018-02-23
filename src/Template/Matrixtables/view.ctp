<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Matrixtable'), ['action' => 'edit', $matrixtable->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Matrixtable'), ['action' => 'delete', $matrixtable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $matrixtable->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Matrixtables'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Matrixtable'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Prices'), ['controller' => 'Prices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Price'), ['controller' => 'Prices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="matrixtables view large-9 medium-8 columns content">
    <h3><?= h($matrixtable->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($matrixtable->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($matrixtable->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Widths') ?></h4>
        <?= $this->Text->autoParagraph(h($matrixtable->widths)); ?>
    </div>
    <div class="row">
        <h4><?= __('Heights') ?></h4>
        <?= $this->Text->autoParagraph(h($matrixtable->heights)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Prices') ?></h4>
        <?php if (!empty($matrixtable->prices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('PricePerMesure') ?></th>
                <th scope="col"><?= __('Matrixtable Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($matrixtable->prices as $prices): ?>
            <tr>
                <td><?= h($prices->id) ?></td>
                <td><?= h($prices->pricePerMesure) ?></td>
                <td><?= h($prices->matrixtable_id) ?></td>
                <td><?= h($prices->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Prices', 'action' => 'view', $prices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Prices', 'action' => 'edit', $prices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Prices', 'action' => 'delete', $prices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
