<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Quote'), ['action' => 'edit', $quote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Quote'), ['action' => 'delete', $quote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="quotes view large-9 medium-8 columns content">
    <h3><?= h($quote->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order Date') ?></th>
            <td><?= h($quote->order_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Required Date') ?></th>
            <td><?= h($quote->required_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Orderin Date') ?></th>
            <td><?= h($quote->orderin_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= h($quote->customer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile') ?></th>
            <td><?= h($quote->mobile) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($quote->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($quote->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fax') ?></th>
            <td><?= h($quote->fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Street') ?></th>
            <td><?= h($quote->street) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Suburb') ?></th>
            <td><?= h($quote->suburb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= h($quote->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard') ?></th>
            <td><?= h($quote->standard) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Second Color Required') ?></th>
            <td><?= h($quote->second_color_required) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color1') ?></th>
            <td><?= h($quote->color1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color2') ?></th>
            <td><?= h($quote->color2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color3') ?></th>
            <td><?= h($quote->color3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color4') ?></th>
            <td><?= h($quote->color4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Standard Color') ?></th>
            <td><?= h($quote->standard_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color1 Color') ?></th>
            <td><?= h($quote->color1_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color2 Color') ?></th>
            <td><?= h($quote->color2_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color3 Color') ?></th>
            <td><?= h($quote->color3_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color4 Color') ?></th>
            <td><?= h($quote->color4_color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Installation Required') ?></th>
            <td><?= h($quote->installation_required) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Count Additional') ?></th>
            <td><?= h($quote->count_additional) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Freight Cost') ?></th>
            <td><?= h($quote->freight_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Window Door Suite Manufacturer') ?></th>
            <td><?= h($quote->window_door_suite_manufacturer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $quote->has('user') ? $this->Html->link($quote->user->username, ['controller' => 'Users', 'action' => 'view', $quote->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($quote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Original Id') ?></th>
            <td><?= $this->Number->format($quote->original_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Additional Installation Amount') ?></th>
            <td><?= $this->Number->format($quote->additional_installation_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($quote->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quoted') ?></th>
            <td><?= $quote->quoted ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Printed') ?></th>
            <td><?= $quote->printed ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Send File To Manufacturer') ?></th>
            <td><?= $quote->send_file_to_manufacturer ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($quote->notes)); ?>
    </div>
    <div class="row">
        <h4><?= __('Notes2') ?></h4>
        <?= $this->Text->autoParagraph(h($quote->notes2)); ?>
    </div>
    <div class="row">
        <h4><?= __('Notes3') ?></h4>
        <?= $this->Text->autoParagraph(h($quote->notes3)); ?>
    </div>
    <div class="row">
        <h4><?= __('Notes4') ?></h4>
        <?= $this->Text->autoParagraph(h($quote->notes4)); ?>
    </div>
    <div class="row">
        <h4><?= __('Mf Role') ?></h4>
        <?= $this->Text->autoParagraph(h($quote->mf_role)); ?>
    </div>
</div>
