<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Quote'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="quotes index large-9 medium-8 columns content">
    <h3><?= __('Quotes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('original_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('required_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('orderin_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('street') ?></th>
                <th scope="col"><?= $this->Paginator->sort('suburb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('standard') ?></th>
                <th scope="col"><?= $this->Paginator->sort('second_color_required') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('standard_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color1_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color2_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color3_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color4_color') ?></th>
                <th scope="col"><?= $this->Paginator->sort('installation_required') ?></th>
                <th scope="col"><?= $this->Paginator->sort('additional_installation_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('count_additional') ?></th>
                <th scope="col"><?= $this->Paginator->sort('freight_cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('window_door_suite_manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quoted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('printed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('send_file_to_manufacturer') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quotes as $quote): ?>
            <tr>
                <td><?= $this->Number->format($quote->id) ?></td>
                <td><?= $this->Number->format($quote->original_id) ?></td>
                <td><?= h($quote->order_date) ?></td>
                <td><?= h($quote->required_date) ?></td>
                <td><?= h($quote->orderin_date) ?></td>
                <td><?= h($quote->customer_name) ?></td>
                <td><?= h($quote->mobile) ?></td>
                <td><?= h($quote->phone) ?></td>
                <td><?= h($quote->email) ?></td>
                <td><?= h($quote->fax) ?></td>
                <td><?= h($quote->street) ?></td>
                <td><?= h($quote->suburb) ?></td>
                <td><?= h($quote->postcode) ?></td>
                <td><?= h($quote->standard) ?></td>
                <td><?= h($quote->second_color_required) ?></td>
                <td><?= h($quote->color1) ?></td>
                <td><?= h($quote->color2) ?></td>
                <td><?= h($quote->color3) ?></td>
                <td><?= h($quote->color4) ?></td>
                <td><?= h($quote->standard_color) ?></td>
                <td><?= h($quote->color1_color) ?></td>
                <td><?= h($quote->color2_color) ?></td>
                <td><?= h($quote->color3_color) ?></td>
                <td><?= h($quote->color4_color) ?></td>
                <td><?= h($quote->installation_required) ?></td>
                <td><?= $this->Number->format($quote->additional_installation_amount) ?></td>
                <td><?= $this->Number->format($quote->status) ?></td>
                <td><?= h($quote->count_additional) ?></td>
                <td><?= h($quote->freight_cost) ?></td>
                <td><?= h($quote->window_door_suite_manufacturer) ?></td>
                <td><?= h($quote->quoted) ?></td>
                <td><?= h($quote->printed) ?></td>
                <td><?= h($quote->send_file_to_manufacturer) ?></td>
                <td><?= $quote->has('user') ? $this->Html->link($quote->user->username, ['controller' => 'Users', 'action' => 'view', $quote->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $quote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $quote->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $quote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quote->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
