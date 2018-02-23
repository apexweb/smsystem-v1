<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Quotes'), ['controller' => 'Quotes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Quote'), ['controller' => 'Quotes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount') ?></th>
            <td><?= $this->Number->format($user->discount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Quotes') ?></h4>
        <?php if (!empty($user->quotes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Original Id') ?></th>
                <th scope="col"><?= __('Order Date') ?></th>
                <th scope="col"><?= __('Required Date') ?></th>
                <th scope="col"><?= __('Orderin Date') ?></th>
                <th scope="col"><?= __('Notes') ?></th>
                <th scope="col"><?= __('Notes2') ?></th>
                <th scope="col"><?= __('Notes3') ?></th>
                <th scope="col"><?= __('Customer Name') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Fax') ?></th>
                <th scope="col"><?= __('Street') ?></th>
                <th scope="col"><?= __('Suburb') ?></th>
                <th scope="col"><?= __('Postcode') ?></th>
                <th scope="col"><?= __('Standard') ?></th>
                <th scope="col"><?= __('Second Color Required') ?></th>
                <th scope="col"><?= __('Color1') ?></th>
                <th scope="col"><?= __('Color2') ?></th>
                <th scope="col"><?= __('Color3') ?></th>
                <th scope="col"><?= __('Color4') ?></th>
                <th scope="col"><?= __('Standard Color') ?></th>
                <th scope="col"><?= __('Color1 Color') ?></th>
                <th scope="col"><?= __('Color2 Color') ?></th>
                <th scope="col"><?= __('Color3 Color') ?></th>
                <th scope="col"><?= __('Color4 Color') ?></th>
                <th scope="col"><?= __('Installation Required') ?></th>
                <th scope="col"><?= __('Additional Installation Amount') ?></th>
                <th scope="col"><?= __('Product1 Item Number') ?></th>
                <th scope="col"><?= __('Product2 Item Number') ?></th>
                <th scope="col"><?= __('Product3 Item Number') ?></th>
                <th scope="col"><?= __('Product4 Item Number') ?></th>
                <th scope="col"><?= __('Product5 Item Number') ?></th>
                <th scope="col"><?= __('Product6 Item Number') ?></th>
                <th scope="col"><?= __('Product7 Item Number') ?></th>
                <th scope="col"><?= __('Product8 Item Number') ?></th>
                <th scope="col"><?= __('Product9 Item Number') ?></th>
                <th scope="col"><?= __('Product10 Item Number') ?></th>
                <th scope="col"><?= __('Product11 Item Number') ?></th>
                <th scope="col"><?= __('Product12 Item Number') ?></th>
                <th scope="col"><?= __('Product13 Item Number') ?></th>
                <th scope="col"><?= __('Product14 Item Number') ?></th>
                <th scope="col"><?= __('Product15 Item Number') ?></th>
                <th scope="col"><?= __('Product16 Item Number') ?></th>
                <th scope="col"><?= __('Product17 Item Number') ?></th>
                <th scope="col"><?= __('Product18 Item Number') ?></th>
                <th scope="col"><?= __('Product19 Item Number') ?></th>
                <th scope="col"><?= __('Product20 Item Number') ?></th>
                <th scope="col"><?= __('Product21 Item Number') ?></th>
                <th scope="col"><?= __('Product22 Item Number') ?></th>
                <th scope="col"><?= __('Product23 Item Number') ?></th>
                <th scope="col"><?= __('Product24 Item Number') ?></th>
                <th scope="col"><?= __('Product25 Item Number') ?></th>
                <th scope="col"><?= __('Product26 Item Number') ?></th>
                <th scope="col"><?= __('Product27 Item Number') ?></th>
                <th scope="col"><?= __('Product28 Item Number') ?></th>
                <th scope="col"><?= __('Product29 Item Number') ?></th>
                <th scope="col"><?= __('Product30 Item Number') ?></th>
                <th scope="col"><?= __('Product1 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product2 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product3 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product4 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product5 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product6 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product7 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product8 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product9 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product10 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product11 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product12 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product13 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product14 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product15 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product16 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product17 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product18 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product19 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product20 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product21 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product22 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product23 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product24 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product25 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product26 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product27 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product28 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product29 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product30 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Product1 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product2 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product3 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product4 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product5 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product6 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product7 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product8 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product9 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product10 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product11 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product12 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product13 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product14 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product15 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product16 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product17 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product18 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product19 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product20 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product21 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product22 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product23 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product24 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product25 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product26 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product27 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product28 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product29 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product30 Quantity Of Panels') ?></th>
                <th scope="col"><?= __('Product1 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product2 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product3 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product4 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product5 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product6 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product7 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product8 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product9 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product10 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product11 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product12 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product13 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product14 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product15 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product16 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product17 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product18 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product19 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product20 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product21 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product22 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product23 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product24 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product25 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product26 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product27 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product28 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product29 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product30 316 Ss Gal Pet') ?></th>
                <th scope="col"><?= __('Product1 Window Or Door') ?></th>
                <th scope="col"><?= __('Product2 Window Or Door') ?></th>
                <th scope="col"><?= __('Product3 Window Or Door') ?></th>
                <th scope="col"><?= __('Product4 Window Or Door') ?></th>
                <th scope="col"><?= __('Product5 Window Or Door') ?></th>
                <th scope="col"><?= __('Product6 Window Or Door') ?></th>
                <th scope="col"><?= __('Product7 Window Or Door') ?></th>
                <th scope="col"><?= __('Product8 Window Or Door') ?></th>
                <th scope="col"><?= __('Product9 Window Or Door') ?></th>
                <th scope="col"><?= __('Product10 Window Or Door') ?></th>
                <th scope="col"><?= __('Product11 Window Or Door') ?></th>
                <th scope="col"><?= __('Product12 Window Or Door') ?></th>
                <th scope="col"><?= __('Product13 Window Or Door') ?></th>
                <th scope="col"><?= __('Product14 Window Or Door') ?></th>
                <th scope="col"><?= __('Product15 Window Or Door') ?></th>
                <th scope="col"><?= __('Product16 Window Or Door') ?></th>
                <th scope="col"><?= __('Product17 Window Or Door') ?></th>
                <th scope="col"><?= __('Product18 Window Or Door') ?></th>
                <th scope="col"><?= __('Product19 Window Or Door') ?></th>
                <th scope="col"><?= __('Product20 Window Or Door') ?></th>
                <th scope="col"><?= __('Product21 Window Or Door') ?></th>
                <th scope="col"><?= __('Product22 Window Or Door') ?></th>
                <th scope="col"><?= __('Product23 Window Or Door') ?></th>
                <th scope="col"><?= __('Product24 Window Or Door') ?></th>
                <th scope="col"><?= __('Product25 Window Or Door') ?></th>
                <th scope="col"><?= __('Product26 Window Or Door') ?></th>
                <th scope="col"><?= __('Product27 Window Or Door') ?></th>
                <th scope="col"><?= __('Product28 Window Or Door') ?></th>
                <th scope="col"><?= __('Product29 Window Or Door') ?></th>
                <th scope="col"><?= __('Product30 Window Or Door') ?></th>
                <th scope="col"><?= __('Product1 Emergency Window') ?></th>
                <th scope="col"><?= __('Product2 Emergency Window') ?></th>
                <th scope="col"><?= __('Product3 Emergency Window') ?></th>
                <th scope="col"><?= __('Product4 Emergency Window') ?></th>
                <th scope="col"><?= __('Product5 Emergency Window') ?></th>
                <th scope="col"><?= __('Product6 Emergency Window') ?></th>
                <th scope="col"><?= __('Product7 Emergency Window') ?></th>
                <th scope="col"><?= __('Product8 Emergency Window') ?></th>
                <th scope="col"><?= __('Product9 Emergency Window') ?></th>
                <th scope="col"><?= __('Product10 Emergency Window') ?></th>
                <th scope="col"><?= __('Product11 Emergency Window') ?></th>
                <th scope="col"><?= __('Product12 Emergency Window') ?></th>
                <th scope="col"><?= __('Product13 Emergency Window') ?></th>
                <th scope="col"><?= __('Product14 Emergency Window') ?></th>
                <th scope="col"><?= __('Product15 Emergency Window') ?></th>
                <th scope="col"><?= __('Product16 Emergency Window') ?></th>
                <th scope="col"><?= __('Product17 Emergency Window') ?></th>
                <th scope="col"><?= __('Product18 Emergency Window') ?></th>
                <th scope="col"><?= __('Product19 Emergency Window') ?></th>
                <th scope="col"><?= __('Product20 Emergency Window') ?></th>
                <th scope="col"><?= __('Product21 Emergency Window') ?></th>
                <th scope="col"><?= __('Product22 Emergency Window') ?></th>
                <th scope="col"><?= __('Product23 Emergency Window') ?></th>
                <th scope="col"><?= __('Product24 Emergency Window') ?></th>
                <th scope="col"><?= __('Product25 Emergency Window') ?></th>
                <th scope="col"><?= __('Product26 Emergency Window') ?></th>
                <th scope="col"><?= __('Product27 Emergency Window') ?></th>
                <th scope="col"><?= __('Product28 Emergency Window') ?></th>
                <th scope="col"><?= __('Product29 Emergency Window') ?></th>
                <th scope="col"><?= __('Product30 Emergency Window') ?></th>
                <th scope="col"><?= __('Product1 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product2 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product3 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product4 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product5 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product6 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product7 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product8 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product9 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product10 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product11 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product12 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product13 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product14 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product15 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product16 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product17 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product18 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product19 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product20 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product21 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product22 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product23 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product24 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product25 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product26 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product27 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product28 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product29 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product30 Window Frame Type') ?></th>
                <th scope="col"><?= __('Product1 Configuration') ?></th>
                <th scope="col"><?= __('Product2 Configuration') ?></th>
                <th scope="col"><?= __('Product3 Configuration') ?></th>
                <th scope="col"><?= __('Product4 Configuration') ?></th>
                <th scope="col"><?= __('Product5 Configuration') ?></th>
                <th scope="col"><?= __('Product6 Configuration') ?></th>
                <th scope="col"><?= __('Product7 Configuration') ?></th>
                <th scope="col"><?= __('Product8 Configuration') ?></th>
                <th scope="col"><?= __('Product9 Configuration') ?></th>
                <th scope="col"><?= __('Product10 Configuration') ?></th>
                <th scope="col"><?= __('Product11 Configuration') ?></th>
                <th scope="col"><?= __('Product12 Configuration') ?></th>
                <th scope="col"><?= __('Product13 Configuration') ?></th>
                <th scope="col"><?= __('Product14 Configuration') ?></th>
                <th scope="col"><?= __('Product15 Configuration') ?></th>
                <th scope="col"><?= __('Product16 Configuration') ?></th>
                <th scope="col"><?= __('Product17 Configuration') ?></th>
                <th scope="col"><?= __('Product18 Configuration') ?></th>
                <th scope="col"><?= __('Product19 Configuration') ?></th>
                <th scope="col"><?= __('Product20 Configuration') ?></th>
                <th scope="col"><?= __('Product21 Configuration') ?></th>
                <th scope="col"><?= __('Product22 Configuration') ?></th>
                <th scope="col"><?= __('Product23 Configuration') ?></th>
                <th scope="col"><?= __('Product24 Configuration') ?></th>
                <th scope="col"><?= __('Product25 Configuration') ?></th>
                <th scope="col"><?= __('Product26 Configuration') ?></th>
                <th scope="col"><?= __('Product27 Configuration') ?></th>
                <th scope="col"><?= __('Product28 Configuration') ?></th>
                <th scope="col"><?= __('Product29 Configuration') ?></th>
                <th scope="col"><?= __('Product30 Configuration') ?></th>
                <th scope="col"><?= __('Product1 Location In Building') ?></th>
                <th scope="col"><?= __('Product2 Location In Building') ?></th>
                <th scope="col"><?= __('Product3 Location In Building') ?></th>
                <th scope="col"><?= __('Product4 Location In Building') ?></th>
                <th scope="col"><?= __('Product5 Location In Building') ?></th>
                <th scope="col"><?= __('Product6 Location In Building') ?></th>
                <th scope="col"><?= __('Product7 Location In Building') ?></th>
                <th scope="col"><?= __('Product8 Location In Building') ?></th>
                <th scope="col"><?= __('Product9 Location In Building') ?></th>
                <th scope="col"><?= __('Product10 Location In Building') ?></th>
                <th scope="col"><?= __('Product11 Location In Building') ?></th>
                <th scope="col"><?= __('Product12 Location In Building') ?></th>
                <th scope="col"><?= __('Product13 Location In Building') ?></th>
                <th scope="col"><?= __('Product14 Location In Building') ?></th>
                <th scope="col"><?= __('Product15 Location In Building') ?></th>
                <th scope="col"><?= __('Product16 Location In Building') ?></th>
                <th scope="col"><?= __('Product17 Location In Building') ?></th>
                <th scope="col"><?= __('Product18 Location In Building') ?></th>
                <th scope="col"><?= __('Product19 Location In Building') ?></th>
                <th scope="col"><?= __('Product20 Location In Building') ?></th>
                <th scope="col"><?= __('Product21 Location In Building') ?></th>
                <th scope="col"><?= __('Product22 Location In Building') ?></th>
                <th scope="col"><?= __('Product23 Location In Building') ?></th>
                <th scope="col"><?= __('Product24 Location In Building') ?></th>
                <th scope="col"><?= __('Product25 Location In Building') ?></th>
                <th scope="col"><?= __('Product26 Location In Building') ?></th>
                <th scope="col"><?= __('Product27 Location In Building') ?></th>
                <th scope="col"><?= __('Product28 Location In Building') ?></th>
                <th scope="col"><?= __('Product29 Location In Building') ?></th>
                <th scope="col"><?= __('Product30 Location In Building') ?></th>
                <th scope="col"><?= __('Product1 Height') ?></th>
                <th scope="col"><?= __('Product2 Height') ?></th>
                <th scope="col"><?= __('Product3 Height') ?></th>
                <th scope="col"><?= __('Product4 Height') ?></th>
                <th scope="col"><?= __('Product5 Height') ?></th>
                <th scope="col"><?= __('Product6 Height') ?></th>
                <th scope="col"><?= __('Product7 Height') ?></th>
                <th scope="col"><?= __('Product8 Height') ?></th>
                <th scope="col"><?= __('Product9 Height') ?></th>
                <th scope="col"><?= __('Product10 Height') ?></th>
                <th scope="col"><?= __('Product11 Height') ?></th>
                <th scope="col"><?= __('Product12 Height') ?></th>
                <th scope="col"><?= __('Product13 Height') ?></th>
                <th scope="col"><?= __('Product14 Height') ?></th>
                <th scope="col"><?= __('Product15 Height') ?></th>
                <th scope="col"><?= __('Product16 Height') ?></th>
                <th scope="col"><?= __('Product17 Height') ?></th>
                <th scope="col"><?= __('Product18 Height') ?></th>
                <th scope="col"><?= __('Product19 Height') ?></th>
                <th scope="col"><?= __('Product20 Height') ?></th>
                <th scope="col"><?= __('Product21 Height') ?></th>
                <th scope="col"><?= __('Product22 Height') ?></th>
                <th scope="col"><?= __('Product23 Height') ?></th>
                <th scope="col"><?= __('Product24 Height') ?></th>
                <th scope="col"><?= __('Product25 Height') ?></th>
                <th scope="col"><?= __('Product26 Height') ?></th>
                <th scope="col"><?= __('Product27 Height') ?></th>
                <th scope="col"><?= __('Product28 Height') ?></th>
                <th scope="col"><?= __('Product29 Height') ?></th>
                <th scope="col"><?= __('Product30 Height') ?></th>
                <th scope="col"><?= __('Product1 Width') ?></th>
                <th scope="col"><?= __('Product2 Width') ?></th>
                <th scope="col"><?= __('Product3 Width') ?></th>
                <th scope="col"><?= __('Product4 Width') ?></th>
                <th scope="col"><?= __('Product5 Width') ?></th>
                <th scope="col"><?= __('Product6 Width') ?></th>
                <th scope="col"><?= __('Product7 Width') ?></th>
                <th scope="col"><?= __('Product8 Width') ?></th>
                <th scope="col"><?= __('Product9 Width') ?></th>
                <th scope="col"><?= __('Product10 Width') ?></th>
                <th scope="col"><?= __('Product11 Width') ?></th>
                <th scope="col"><?= __('Product12 Width') ?></th>
                <th scope="col"><?= __('Product13 Width') ?></th>
                <th scope="col"><?= __('Product14 Width') ?></th>
                <th scope="col"><?= __('Product15 Width') ?></th>
                <th scope="col"><?= __('Product16 Width') ?></th>
                <th scope="col"><?= __('Product17 Width') ?></th>
                <th scope="col"><?= __('Product18 Width') ?></th>
                <th scope="col"><?= __('Product19 Width') ?></th>
                <th scope="col"><?= __('Product20 Width') ?></th>
                <th scope="col"><?= __('Product21 Width') ?></th>
                <th scope="col"><?= __('Product22 Width') ?></th>
                <th scope="col"><?= __('Product23 Width') ?></th>
                <th scope="col"><?= __('Product24 Width') ?></th>
                <th scope="col"><?= __('Product25 Width') ?></th>
                <th scope="col"><?= __('Product26 Width') ?></th>
                <th scope="col"><?= __('Product27 Width') ?></th>
                <th scope="col"><?= __('Product28 Width') ?></th>
                <th scope="col"><?= __('Product29 Width') ?></th>
                <th scope="col"><?= __('Product30 Width') ?></th>
                <th scope="col"><?= __('Product1 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product2 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product3 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product4 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product5 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product6 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product7 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product8 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product9 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product10 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product11 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product12 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product13 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product14 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product15 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product16 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product17 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product18 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product19 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product20 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product21 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product22 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product23 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product24 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product25 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product26 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product27 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product28 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product29 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product30 Number Of Locks') ?></th>
                <th scope="col"><?= __('Product1 Lock Type') ?></th>
                <th scope="col"><?= __('Product2 Lock Type') ?></th>
                <th scope="col"><?= __('Product3 Lock Type') ?></th>
                <th scope="col"><?= __('Product4 Lock Type') ?></th>
                <th scope="col"><?= __('Product5 Lock Type') ?></th>
                <th scope="col"><?= __('Product6 Lock Type') ?></th>
                <th scope="col"><?= __('Product7 Lock Type') ?></th>
                <th scope="col"><?= __('Product8 Lock Type') ?></th>
                <th scope="col"><?= __('Product9 Lock Type') ?></th>
                <th scope="col"><?= __('Product10 Lock Type') ?></th>
                <th scope="col"><?= __('Product11 Lock Type') ?></th>
                <th scope="col"><?= __('Product12 Lock Type') ?></th>
                <th scope="col"><?= __('Product13 Lock Type') ?></th>
                <th scope="col"><?= __('Product14 Lock Type') ?></th>
                <th scope="col"><?= __('Product15 Lock Type') ?></th>
                <th scope="col"><?= __('Product16 Lock Type') ?></th>
                <th scope="col"><?= __('Product17 Lock Type') ?></th>
                <th scope="col"><?= __('Product18 Lock Type') ?></th>
                <th scope="col"><?= __('Product19 Lock Type') ?></th>
                <th scope="col"><?= __('Product20 Lock Type') ?></th>
                <th scope="col"><?= __('Product21 Lock Type') ?></th>
                <th scope="col"><?= __('Product22 Lock Type') ?></th>
                <th scope="col"><?= __('Product23 Lock Type') ?></th>
                <th scope="col"><?= __('Product24 Lock Type') ?></th>
                <th scope="col"><?= __('Product25 Lock Type') ?></th>
                <th scope="col"><?= __('Product26 Lock Type') ?></th>
                <th scope="col"><?= __('Product27 Lock Type') ?></th>
                <th scope="col"><?= __('Product28 Lock Type') ?></th>
                <th scope="col"><?= __('Product29 Lock Type') ?></th>
                <th scope="col"><?= __('Product30 Lock Type') ?></th>
                <th scope="col"><?= __('Product1 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product2 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product3 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product4 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product5 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product6 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product7 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product8 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product9 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product10 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product11 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product12 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product13 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product14 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product15 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product16 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product17 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product18 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product19 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product20 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product21 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product22 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product23 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product24 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product25 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product26 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product27 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product28 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product29 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Product30 Lock Handle Height') ?></th>
                <th scope="col"><?= __('Additional1 Item Number') ?></th>
                <th scope="col"><?= __('Additional2 Item Number') ?></th>
                <th scope="col"><?= __('Additional3 Item Number') ?></th>
                <th scope="col"><?= __('Additional4 Item Number') ?></th>
                <th scope="col"><?= __('Additional5 Item Number') ?></th>
                <th scope="col"><?= __('Additional6 Item Number') ?></th>
                <th scope="col"><?= __('Additional7 Item Number') ?></th>
                <th scope="col"><?= __('Additional8 Item Number') ?></th>
                <th scope="col"><?= __('Additional9 Item Number') ?></th>
                <th scope="col"><?= __('Additional10 Item Number') ?></th>
                <th scope="col"><?= __('Additional1 Name') ?></th>
                <th scope="col"><?= __('Additional2 Name') ?></th>
                <th scope="col"><?= __('Additional3 Name') ?></th>
                <th scope="col"><?= __('Additional4 Name') ?></th>
                <th scope="col"><?= __('Additional5 Name') ?></th>
                <th scope="col"><?= __('Additional6 Name') ?></th>
                <th scope="col"><?= __('Additional7 Name') ?></th>
                <th scope="col"><?= __('Additional8 Name') ?></th>
                <th scope="col"><?= __('Additional9 Name') ?></th>
                <th scope="col"><?= __('Additional10 Name') ?></th>
                <th scope="col"><?= __('Additional1 Per Meter') ?></th>
                <th scope="col"><?= __('Additional2 Per Meter') ?></th>
                <th scope="col"><?= __('Additional3 Per Meter') ?></th>
                <th scope="col"><?= __('Additional4 Per Meter') ?></th>
                <th scope="col"><?= __('Additional5 Per Meter') ?></th>
                <th scope="col"><?= __('Additional6 Per Meter') ?></th>
                <th scope="col"><?= __('Additional7 Per Meter') ?></th>
                <th scope="col"><?= __('Additional8 Per Meter') ?></th>
                <th scope="col"><?= __('Additional9 Per Meter') ?></th>
                <th scope="col"><?= __('Additional10 Per Meter') ?></th>
                <th scope="col"><?= __('Additional1 Price') ?></th>
                <th scope="col"><?= __('Additional2 Price') ?></th>
                <th scope="col"><?= __('Additional3 Price') ?></th>
                <th scope="col"><?= __('Additional4 Price') ?></th>
                <th scope="col"><?= __('Additional5 Price') ?></th>
                <th scope="col"><?= __('Additional6 Price') ?></th>
                <th scope="col"><?= __('Additional7 Price') ?></th>
                <th scope="col"><?= __('Additional8 Price') ?></th>
                <th scope="col"><?= __('Additional9 Price') ?></th>
                <th scope="col"><?= __('Additional10 Price') ?></th>
                <th scope="col"><?= __('Additional1 L Item Number') ?></th>
                <th scope="col"><?= __('Additional2 L Item Number') ?></th>
                <th scope="col"><?= __('Additional3 L Item Number') ?></th>
                <th scope="col"><?= __('Additional4 L Item Number') ?></th>
                <th scope="col"><?= __('Additional5 L Item Number') ?></th>
                <th scope="col"><?= __('Additional1 L Name') ?></th>
                <th scope="col"><?= __('Additional2 L Name') ?></th>
                <th scope="col"><?= __('Additional3 L Name') ?></th>
                <th scope="col"><?= __('Additional4 L Name') ?></th>
                <th scope="col"><?= __('Additional5 L Name') ?></th>
                <th scope="col"><?= __('Additional1 L Per Length') ?></th>
                <th scope="col"><?= __('Additional2 L Per Length') ?></th>
                <th scope="col"><?= __('Additional3 L Per Length') ?></th>
                <th scope="col"><?= __('Additional4 L Per Length') ?></th>
                <th scope="col"><?= __('Additional5 L Per Length') ?></th>
                <th scope="col"><?= __('Additional1 L Price') ?></th>
                <th scope="col"><?= __('Additional2 L Price') ?></th>
                <th scope="col"><?= __('Additional3 L Price') ?></th>
                <th scope="col"><?= __('Additional4 L Price') ?></th>
                <th scope="col"><?= __('Additional5 L Price') ?></th>
                <th scope="col"><?= __('Accessory1 Item Number') ?></th>
                <th scope="col"><?= __('Accessory2 Item Number') ?></th>
                <th scope="col"><?= __('Accessory3 Item Number') ?></th>
                <th scope="col"><?= __('Accessory1 Each') ?></th>
                <th scope="col"><?= __('Accessory2 Each') ?></th>
                <th scope="col"><?= __('Accessory3 Each') ?></th>
                <th scope="col"><?= __('Accessory1 Name') ?></th>
                <th scope="col"><?= __('Accessory2 Name') ?></th>
                <th scope="col"><?= __('Accessory3 Name') ?></th>
                <th scope="col"><?= __('Accessory1 Price') ?></th>
                <th scope="col"><?= __('Accessory2 Price') ?></th>
                <th scope="col"><?= __('Accessory3 Price') ?></th>
                <th scope="col"><?= __('Creator Id') ?></th>
                <th scope="col"><?= __('Product1 Cost Dist') ?></th>
                <th scope="col"><?= __('Product2 Cost Dist') ?></th>
                <th scope="col"><?= __('Product3 Cost Dist') ?></th>
                <th scope="col"><?= __('Product4 Cost Dist') ?></th>
                <th scope="col"><?= __('Product5 Cost Dist') ?></th>
                <th scope="col"><?= __('Product6 Cost Dist') ?></th>
                <th scope="col"><?= __('Product7 Cost Dist') ?></th>
                <th scope="col"><?= __('Product8 Cost Dist') ?></th>
                <th scope="col"><?= __('Product9 Cost Dist') ?></th>
                <th scope="col"><?= __('Product10 Cost Dist') ?></th>
                <th scope="col"><?= __('Product11 Cost Dist') ?></th>
                <th scope="col"><?= __('Product12 Cost Dist') ?></th>
                <th scope="col"><?= __('Product13 Cost Dist') ?></th>
                <th scope="col"><?= __('Product14 Cost Dist') ?></th>
                <th scope="col"><?= __('Product15 Cost Dist') ?></th>
                <th scope="col"><?= __('Product16 Cost Dist') ?></th>
                <th scope="col"><?= __('Product17 Cost Dist') ?></th>
                <th scope="col"><?= __('Product18 Cost Dist') ?></th>
                <th scope="col"><?= __('Product19 Cost Dist') ?></th>
                <th scope="col"><?= __('Product20 Cost Dist') ?></th>
                <th scope="col"><?= __('Product21 Cost Dist') ?></th>
                <th scope="col"><?= __('Product22 Cost Dist') ?></th>
                <th scope="col"><?= __('Product23 Cost Dist') ?></th>
                <th scope="col"><?= __('Product24 Cost Dist') ?></th>
                <th scope="col"><?= __('Product25 Cost Dist') ?></th>
                <th scope="col"><?= __('Product26 Cost Dist') ?></th>
                <th scope="col"><?= __('Product27 Cost Dist') ?></th>
                <th scope="col"><?= __('Product28 Cost Dist') ?></th>
                <th scope="col"><?= __('Product29 Cost Dist') ?></th>
                <th scope="col"><?= __('Product30 Cost Dist') ?></th>
                <th scope="col"><?= __('Product1 Cost Wls') ?></th>
                <th scope="col"><?= __('Product2 Cost Wls') ?></th>
                <th scope="col"><?= __('Product3 Cost Wls') ?></th>
                <th scope="col"><?= __('Product4 Cost Wls') ?></th>
                <th scope="col"><?= __('Product5 Cost Wls') ?></th>
                <th scope="col"><?= __('Product6 Cost Wls') ?></th>
                <th scope="col"><?= __('Product7 Cost Wls') ?></th>
                <th scope="col"><?= __('Product8 Cost Wls') ?></th>
                <th scope="col"><?= __('Product9 Cost Wls') ?></th>
                <th scope="col"><?= __('Product10 Cost Wls') ?></th>
                <th scope="col"><?= __('Product11 Cost Wls') ?></th>
                <th scope="col"><?= __('Product12 Cost Wls') ?></th>
                <th scope="col"><?= __('Product13 Cost Wls') ?></th>
                <th scope="col"><?= __('Product14 Cost Wls') ?></th>
                <th scope="col"><?= __('Product15 Cost Wls') ?></th>
                <th scope="col"><?= __('Product16 Cost Wls') ?></th>
                <th scope="col"><?= __('Product17 Cost Wls') ?></th>
                <th scope="col"><?= __('Product18 Cost Wls') ?></th>
                <th scope="col"><?= __('Product19 Cost Wls') ?></th>
                <th scope="col"><?= __('Product20 Cost Wls') ?></th>
                <th scope="col"><?= __('Product21 Cost Wls') ?></th>
                <th scope="col"><?= __('Product22 Cost Wls') ?></th>
                <th scope="col"><?= __('Product23 Cost Wls') ?></th>
                <th scope="col"><?= __('Product24 Cost Wls') ?></th>
                <th scope="col"><?= __('Product25 Cost Wls') ?></th>
                <th scope="col"><?= __('Product26 Cost Wls') ?></th>
                <th scope="col"><?= __('Product27 Cost Wls') ?></th>
                <th scope="col"><?= __('Product28 Cost Wls') ?></th>
                <th scope="col"><?= __('Product29 Cost Wls') ?></th>
                <th scope="col"><?= __('Product30 Cost Wls') ?></th>
                <th scope="col"><?= __('Product1 Cost Re') ?></th>
                <th scope="col"><?= __('Product2 Cost Re') ?></th>
                <th scope="col"><?= __('Product3 Cost Re') ?></th>
                <th scope="col"><?= __('Product4 Cost Re') ?></th>
                <th scope="col"><?= __('Product5 Cost Re') ?></th>
                <th scope="col"><?= __('Product6 Cost Re') ?></th>
                <th scope="col"><?= __('Product7 Cost Re') ?></th>
                <th scope="col"><?= __('Product8 Cost Re') ?></th>
                <th scope="col"><?= __('Product9 Cost Re') ?></th>
                <th scope="col"><?= __('Product10 Cost Re') ?></th>
                <th scope="col"><?= __('Product11 Cost Re') ?></th>
                <th scope="col"><?= __('Product12 Cost Re') ?></th>
                <th scope="col"><?= __('Product13 Cost Re') ?></th>
                <th scope="col"><?= __('Product14 Cost Re') ?></th>
                <th scope="col"><?= __('Product15 Cost Re') ?></th>
                <th scope="col"><?= __('Product16 Cost Re') ?></th>
                <th scope="col"><?= __('Product17 Cost Re') ?></th>
                <th scope="col"><?= __('Product18 Cost Re') ?></th>
                <th scope="col"><?= __('Product19 Cost Re') ?></th>
                <th scope="col"><?= __('Product20 Cost Re') ?></th>
                <th scope="col"><?= __('Product21 Cost Re') ?></th>
                <th scope="col"><?= __('Product22 Cost Re') ?></th>
                <th scope="col"><?= __('Product23 Cost Re') ?></th>
                <th scope="col"><?= __('Product24 Cost Re') ?></th>
                <th scope="col"><?= __('Product25 Cost Re') ?></th>
                <th scope="col"><?= __('Product26 Cost Re') ?></th>
                <th scope="col"><?= __('Product27 Cost Re') ?></th>
                <th scope="col"><?= __('Product28 Cost Re') ?></th>
                <th scope="col"><?= __('Product29 Cost Re') ?></th>
                <th scope="col"><?= __('Product30 Cost Re') ?></th>
                <th scope="col"><?= __('Midrails Item Number') ?></th>
                <th scope="col"><?= __('Midrails Quantity') ?></th>
                <th scope="col"><?= __('Midrails Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Midrails 316 Ssgal Pet') ?></th>
                <th scope="col"><?= __('Midrails Window Or Door') ?></th>
                <th scope="col"><?= __('Midrails Height') ?></th>
                <th scope="col"><?= __('Midrails Width') ?></th>
                <th scope="col"><?= __('Midrails Cost Dist') ?></th>
                <th scope="col"><?= __('Midrails Cost Wls') ?></th>
                <th scope="col"><?= __('Midrails Cost Re') ?></th>
                <th scope="col"><?= __('Midrails Window Frame Type') ?></th>
                <th scope="col"><?= __('Midrails Configuration') ?></th>
                <th scope="col"><?= __('Midrails2 Item Number') ?></th>
                <th scope="col"><?= __('Midrails2 Quantity') ?></th>
                <th scope="col"><?= __('Midrails2 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Midrails2 316 Ssgal Pet') ?></th>
                <th scope="col"><?= __('Midrails2 Window Or Door') ?></th>
                <th scope="col"><?= __('Midrails2 Height') ?></th>
                <th scope="col"><?= __('Midrails2 Width') ?></th>
                <th scope="col"><?= __('Midrails2 Cost Dist') ?></th>
                <th scope="col"><?= __('Midrails2 Cost Wls') ?></th>
                <th scope="col"><?= __('Midrails2 Cost Re') ?></th>
                <th scope="col"><?= __('Midrails2 Window Frame Type') ?></th>
                <th scope="col"><?= __('Midrails2 Configuration') ?></th>
                <th scope="col"><?= __('Midrails3 Item Number') ?></th>
                <th scope="col"><?= __('Midrails3 Quantity') ?></th>
                <th scope="col"><?= __('Midrails3 Security Dgrille Fibre') ?></th>
                <th scope="col"><?= __('Midrails3 316 Ssgal Pet') ?></th>
                <th scope="col"><?= __('Midrails3 Window Or Door') ?></th>
                <th scope="col"><?= __('Midrails3 Height') ?></th>
                <th scope="col"><?= __('Midrails3 Width') ?></th>
                <th scope="col"><?= __('Midrails3 Cost Dist') ?></th>
                <th scope="col"><?= __('Midrails3 Cost Wls') ?></th>
                <th scope="col"><?= __('Midrails3 Cost Re') ?></th>
                <th scope="col"><?= __('Midrails3 Window Frame Type') ?></th>
                <th scope="col"><?= __('Midrails3 Configuration') ?></th>
                <th scope="col"><?= __('Installation Total') ?></th>
                <th scope="col"><?= __('Discount Wh') ?></th>
                <th scope="col"><?= __('Discount D') ?></th>
                <th scope="col"><?= __('Discount Re') ?></th>
                <th scope="col"><?= __('Markup Wh') ?></th>
                <th scope="col"><?= __('Markup D') ?></th>
                <th scope="col"><?= __('Extra1 Qty') ?></th>
                <th scope="col"><?= __('Extra1 Description') ?></th>
                <th scope="col"><?= __('Extra1 Count') ?></th>
                <th scope="col"><?= __('Extra1 Price') ?></th>
                <th scope="col"><?= __('Extra1 Markup') ?></th>
                <th scope="col"><?= __('Extra2 Qty') ?></th>
                <th scope="col"><?= __('Extra2 Description') ?></th>
                <th scope="col"><?= __('Extra2 Count') ?></th>
                <th scope="col"><?= __('Extra2 Price') ?></th>
                <th scope="col"><?= __('Extra2 Markup') ?></th>
                <th scope="col"><?= __('Extra3 Qty') ?></th>
                <th scope="col"><?= __('Extra3 Description') ?></th>
                <th scope="col"><?= __('Extra3 Count') ?></th>
                <th scope="col"><?= __('Extra3 Price') ?></th>
                <th scope="col"><?= __('Extra3 Markup') ?></th>
                <th scope="col"><?= __('Extra4 Qty') ?></th>
                <th scope="col"><?= __('Extra4 Description') ?></th>
                <th scope="col"><?= __('Extra4 Count') ?></th>
                <th scope="col"><?= __('Extra4 Price') ?></th>
                <th scope="col"><?= __('Extra4 Markup') ?></th>
                <th scope="col"><?= __('Extra5 Qty') ?></th>
                <th scope="col"><?= __('Extra5 Description') ?></th>
                <th scope="col"><?= __('Extra5 Count') ?></th>
                <th scope="col"><?= __('Extra5 Price') ?></th>
                <th scope="col"><?= __('Extra5 Markup') ?></th>
                <th scope="col"><?= __('Extra6 Qty') ?></th>
                <th scope="col"><?= __('Extra6 Description') ?></th>
                <th scope="col"><?= __('Extra6 Count') ?></th>
                <th scope="col"><?= __('Extra6 Price') ?></th>
                <th scope="col"><?= __('Extra6 Markup') ?></th>
                <th scope="col"><?= __('Extra7 Qty') ?></th>
                <th scope="col"><?= __('Extra7 Description') ?></th>
                <th scope="col"><?= __('Extra7 Count') ?></th>
                <th scope="col"><?= __('Extra7 Price') ?></th>
                <th scope="col"><?= __('Extra7 Markup') ?></th>
                <th scope="col"><?= __('Extra8 Qty') ?></th>
                <th scope="col"><?= __('Extra8 Description') ?></th>
                <th scope="col"><?= __('Extra8 Count') ?></th>
                <th scope="col"><?= __('Extra8 Price') ?></th>
                <th scope="col"><?= __('Extra8 Markup') ?></th>
                <th scope="col"><?= __('Extra9 Qty') ?></th>
                <th scope="col"><?= __('Extra9 Description') ?></th>
                <th scope="col"><?= __('Extra9 Count') ?></th>
                <th scope="col"><?= __('Extra9 Price') ?></th>
                <th scope="col"><?= __('Extra9 Markup') ?></th>
                <th scope="col"><?= __('Extra10 Qty') ?></th>
                <th scope="col"><?= __('Extra10 Description') ?></th>
                <th scope="col"><?= __('Extra10 Count') ?></th>
                <th scope="col"><?= __('Extra10 Price') ?></th>
                <th scope="col"><?= __('Extra10 Markup') ?></th>
                <th scope="col"><?= __('Invoice D Second 1 Price') ?></th>
                <th scope="col"><?= __('Invoice D Second 2 Price') ?></th>
                <th scope="col"><?= __('Invoice Re Second 1 Price') ?></th>
                <th scope="col"><?= __('Invoice Re Second 2 Price') ?></th>
                <th scope="col"><?= __('Invoice Wh Second 1 Price') ?></th>
                <th scope="col"><?= __('Invoice Wh Second 2 Price') ?></th>
                <th scope="col"><?= __('Invoice D Second 1 Description') ?></th>
                <th scope="col"><?= __('Invoice D Second 2 Description') ?></th>
                <th scope="col"><?= __('Invoice Re Second 1 Description') ?></th>
                <th scope="col"><?= __('Invoice Re Second 2 Description') ?></th>
                <th scope="col"><?= __('Invoice Wh Second 1 Description') ?></th>
                <th scope="col"><?= __('Invoice Wh Second 2 Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Count Additional') ?></th>
                <th scope="col"><?= __('Check Override Final D') ?></th>
                <th scope="col"><?= __('Check Override Final Wh') ?></th>
                <th scope="col"><?= __('Check Override Final Re') ?></th>
                <th scope="col"><?= __('Override Final D') ?></th>
                <th scope="col"><?= __('Override Final Wh') ?></th>
                <th scope="col"><?= __('Override Final Re') ?></th>
                <th scope="col"><?= __('Installation Cost Include On Check Measure') ?></th>
                <th scope="col"><?= __('Freight Cost') ?></th>
                <th scope="col"><?= __('Notes4') ?></th>
                <th scope="col"><?= __('Markup D Ss') ?></th>
                <th scope="col"><?= __('Markup D Dg') ?></th>
                <th scope="col"><?= __('Markup Wh Ss') ?></th>
                <th scope="col"><?= __('Markup Wh Dg') ?></th>
                <th scope="col"><?= __('Window Door Suite Manufacturer') ?></th>
                <th scope="col"><?= __('Quoted') ?></th>
                <th scope="col"><?= __('Printed') ?></th>
                <th scope="col"><?= __('Send File To Manufacturer') ?></th>
                <th scope="col"><?= __('Mf Role') ?></th>
                <th scope="col"><?= __('Hidden') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->quotes as $quotes): ?>
            <tr>
                <td><?= h($quotes->id) ?></td>
                <td><?= h($quotes->original_id) ?></td>
                <td><?= h($quotes->order_date) ?></td>
                <td><?= h($quotes->required_date) ?></td>
                <td><?= h($quotes->orderin_date) ?></td>
                <td><?= h($quotes->notes) ?></td>
                <td><?= h($quotes->notes2) ?></td>
                <td><?= h($quotes->notes3) ?></td>
                <td><?= h($quotes->customer_name) ?></td>
                <td><?= h($quotes->mobile) ?></td>
                <td><?= h($quotes->phone) ?></td>
                <td><?= h($quotes->email) ?></td>
                <td><?= h($quotes->fax) ?></td>
                <td><?= h($quotes->street) ?></td>
                <td><?= h($quotes->suburb) ?></td>
                <td><?= h($quotes->postcode) ?></td>
                <td><?= h($quotes->standard) ?></td>
                <td><?= h($quotes->second_color_required) ?></td>
                <td><?= h($quotes->color1) ?></td>
                <td><?= h($quotes->color2) ?></td>
                <td><?= h($quotes->color3) ?></td>
                <td><?= h($quotes->color4) ?></td>
                <td><?= h($quotes->standard_color) ?></td>
                <td><?= h($quotes->color1_color) ?></td>
                <td><?= h($quotes->color2_color) ?></td>
                <td><?= h($quotes->color3_color) ?></td>
                <td><?= h($quotes->color4_color) ?></td>
                <td><?= h($quotes->installation_required) ?></td>
                <td><?= h($quotes->additional_installation_amount) ?></td>
                <td><?= h($quotes->product1_item_number) ?></td>
                <td><?= h($quotes->product2_item_number) ?></td>
                <td><?= h($quotes->product3_item_number) ?></td>
                <td><?= h($quotes->product4_item_number) ?></td>
                <td><?= h($quotes->product5_item_number) ?></td>
                <td><?= h($quotes->product6_item_number) ?></td>
                <td><?= h($quotes->product7_item_number) ?></td>
                <td><?= h($quotes->product8_item_number) ?></td>
                <td><?= h($quotes->product9_item_number) ?></td>
                <td><?= h($quotes->product10_item_number) ?></td>
                <td><?= h($quotes->product11_item_number) ?></td>
                <td><?= h($quotes->product12_item_number) ?></td>
                <td><?= h($quotes->product13_item_number) ?></td>
                <td><?= h($quotes->product14_item_number) ?></td>
                <td><?= h($quotes->product15_item_number) ?></td>
                <td><?= h($quotes->product16_item_number) ?></td>
                <td><?= h($quotes->product17_item_number) ?></td>
                <td><?= h($quotes->product18_item_number) ?></td>
                <td><?= h($quotes->product19_item_number) ?></td>
                <td><?= h($quotes->product20_item_number) ?></td>
                <td><?= h($quotes->product21_item_number) ?></td>
                <td><?= h($quotes->product22_item_number) ?></td>
                <td><?= h($quotes->product23_item_number) ?></td>
                <td><?= h($quotes->product24_item_number) ?></td>
                <td><?= h($quotes->product25_item_number) ?></td>
                <td><?= h($quotes->product26_item_number) ?></td>
                <td><?= h($quotes->product27_item_number) ?></td>
                <td><?= h($quotes->product28_item_number) ?></td>
                <td><?= h($quotes->product29_item_number) ?></td>
                <td><?= h($quotes->product30_item_number) ?></td>
                <td><?= h($quotes->product1_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product2_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product3_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product4_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product5_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product6_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product7_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product8_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product9_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product10_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product11_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product12_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product13_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product14_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product15_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product16_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product17_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product18_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product19_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product20_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product21_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product22_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product23_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product24_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product25_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product26_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product27_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product28_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product29_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product30_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->product1_quantity_of_panels) ?></td>
                <td><?= h($quotes->product2_quantity_of_panels) ?></td>
                <td><?= h($quotes->product3_quantity_of_panels) ?></td>
                <td><?= h($quotes->product4_quantity_of_panels) ?></td>
                <td><?= h($quotes->product5_quantity_of_panels) ?></td>
                <td><?= h($quotes->product6_quantity_of_panels) ?></td>
                <td><?= h($quotes->product7_quantity_of_panels) ?></td>
                <td><?= h($quotes->product8_quantity_of_panels) ?></td>
                <td><?= h($quotes->product9_quantity_of_panels) ?></td>
                <td><?= h($quotes->product10_quantity_of_panels) ?></td>
                <td><?= h($quotes->product11_quantity_of_panels) ?></td>
                <td><?= h($quotes->product12_quantity_of_panels) ?></td>
                <td><?= h($quotes->product13_quantity_of_panels) ?></td>
                <td><?= h($quotes->product14_quantity_of_panels) ?></td>
                <td><?= h($quotes->product15_quantity_of_panels) ?></td>
                <td><?= h($quotes->product16_quantity_of_panels) ?></td>
                <td><?= h($quotes->product17_quantity_of_panels) ?></td>
                <td><?= h($quotes->product18_quantity_of_panels) ?></td>
                <td><?= h($quotes->product19_quantity_of_panels) ?></td>
                <td><?= h($quotes->product20_quantity_of_panels) ?></td>
                <td><?= h($quotes->product21_quantity_of_panels) ?></td>
                <td><?= h($quotes->product22_quantity_of_panels) ?></td>
                <td><?= h($quotes->product23_quantity_of_panels) ?></td>
                <td><?= h($quotes->product24_quantity_of_panels) ?></td>
                <td><?= h($quotes->product25_quantity_of_panels) ?></td>
                <td><?= h($quotes->product26_quantity_of_panels) ?></td>
                <td><?= h($quotes->product27_quantity_of_panels) ?></td>
                <td><?= h($quotes->product28_quantity_of_panels) ?></td>
                <td><?= h($quotes->product29_quantity_of_panels) ?></td>
                <td><?= h($quotes->product30_quantity_of_panels) ?></td>
                <td><?= h($quotes->product1_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product2_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product3_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product4_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product5_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product6_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product7_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product8_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product9_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product10_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product11_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product12_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product13_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product14_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product15_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product16_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product17_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product18_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product19_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product20_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product21_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product22_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product23_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product24_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product25_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product26_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product27_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product28_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product29_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product30_316_ss_gal_pet) ?></td>
                <td><?= h($quotes->product1_window_or_door) ?></td>
                <td><?= h($quotes->product2_window_or_door) ?></td>
                <td><?= h($quotes->product3_window_or_door) ?></td>
                <td><?= h($quotes->product4_window_or_door) ?></td>
                <td><?= h($quotes->product5_window_or_door) ?></td>
                <td><?= h($quotes->product6_window_or_door) ?></td>
                <td><?= h($quotes->product7_window_or_door) ?></td>
                <td><?= h($quotes->product8_window_or_door) ?></td>
                <td><?= h($quotes->product9_window_or_door) ?></td>
                <td><?= h($quotes->product10_window_or_door) ?></td>
                <td><?= h($quotes->product11_window_or_door) ?></td>
                <td><?= h($quotes->product12_window_or_door) ?></td>
                <td><?= h($quotes->product13_window_or_door) ?></td>
                <td><?= h($quotes->product14_window_or_door) ?></td>
                <td><?= h($quotes->product15_window_or_door) ?></td>
                <td><?= h($quotes->product16_window_or_door) ?></td>
                <td><?= h($quotes->product17_window_or_door) ?></td>
                <td><?= h($quotes->product18_window_or_door) ?></td>
                <td><?= h($quotes->product19_window_or_door) ?></td>
                <td><?= h($quotes->product20_window_or_door) ?></td>
                <td><?= h($quotes->product21_window_or_door) ?></td>
                <td><?= h($quotes->product22_window_or_door) ?></td>
                <td><?= h($quotes->product23_window_or_door) ?></td>
                <td><?= h($quotes->product24_window_or_door) ?></td>
                <td><?= h($quotes->product25_window_or_door) ?></td>
                <td><?= h($quotes->product26_window_or_door) ?></td>
                <td><?= h($quotes->product27_window_or_door) ?></td>
                <td><?= h($quotes->product28_window_or_door) ?></td>
                <td><?= h($quotes->product29_window_or_door) ?></td>
                <td><?= h($quotes->product30_window_or_door) ?></td>
                <td><?= h($quotes->product1_emergency_window) ?></td>
                <td><?= h($quotes->product2_emergency_window) ?></td>
                <td><?= h($quotes->product3_emergency_window) ?></td>
                <td><?= h($quotes->product4_emergency_window) ?></td>
                <td><?= h($quotes->product5_emergency_window) ?></td>
                <td><?= h($quotes->product6_emergency_window) ?></td>
                <td><?= h($quotes->product7_emergency_window) ?></td>
                <td><?= h($quotes->product8_emergency_window) ?></td>
                <td><?= h($quotes->product9_emergency_window) ?></td>
                <td><?= h($quotes->product10_emergency_window) ?></td>
                <td><?= h($quotes->product11_emergency_window) ?></td>
                <td><?= h($quotes->product12_emergency_window) ?></td>
                <td><?= h($quotes->product13_emergency_window) ?></td>
                <td><?= h($quotes->product14_emergency_window) ?></td>
                <td><?= h($quotes->product15_emergency_window) ?></td>
                <td><?= h($quotes->product16_emergency_window) ?></td>
                <td><?= h($quotes->product17_emergency_window) ?></td>
                <td><?= h($quotes->product18_emergency_window) ?></td>
                <td><?= h($quotes->product19_emergency_window) ?></td>
                <td><?= h($quotes->product20_emergency_window) ?></td>
                <td><?= h($quotes->product21_emergency_window) ?></td>
                <td><?= h($quotes->product22_emergency_window) ?></td>
                <td><?= h($quotes->product23_emergency_window) ?></td>
                <td><?= h($quotes->product24_emergency_window) ?></td>
                <td><?= h($quotes->product25_emergency_window) ?></td>
                <td><?= h($quotes->product26_emergency_window) ?></td>
                <td><?= h($quotes->product27_emergency_window) ?></td>
                <td><?= h($quotes->product28_emergency_window) ?></td>
                <td><?= h($quotes->product29_emergency_window) ?></td>
                <td><?= h($quotes->product30_emergency_window) ?></td>
                <td><?= h($quotes->product1_window_frame_type) ?></td>
                <td><?= h($quotes->product2_window_frame_type) ?></td>
                <td><?= h($quotes->product3_window_frame_type) ?></td>
                <td><?= h($quotes->product4_window_frame_type) ?></td>
                <td><?= h($quotes->product5_window_frame_type) ?></td>
                <td><?= h($quotes->product6_window_frame_type) ?></td>
                <td><?= h($quotes->product7_window_frame_type) ?></td>
                <td><?= h($quotes->product8_window_frame_type) ?></td>
                <td><?= h($quotes->product9_window_frame_type) ?></td>
                <td><?= h($quotes->product10_window_frame_type) ?></td>
                <td><?= h($quotes->product11_window_frame_type) ?></td>
                <td><?= h($quotes->product12_window_frame_type) ?></td>
                <td><?= h($quotes->product13_window_frame_type) ?></td>
                <td><?= h($quotes->product14_window_frame_type) ?></td>
                <td><?= h($quotes->product15_window_frame_type) ?></td>
                <td><?= h($quotes->product16_window_frame_type) ?></td>
                <td><?= h($quotes->product17_window_frame_type) ?></td>
                <td><?= h($quotes->product18_window_frame_type) ?></td>
                <td><?= h($quotes->product19_window_frame_type) ?></td>
                <td><?= h($quotes->product20_window_frame_type) ?></td>
                <td><?= h($quotes->product21_window_frame_type) ?></td>
                <td><?= h($quotes->product22_window_frame_type) ?></td>
                <td><?= h($quotes->product23_window_frame_type) ?></td>
                <td><?= h($quotes->product24_window_frame_type) ?></td>
                <td><?= h($quotes->product25_window_frame_type) ?></td>
                <td><?= h($quotes->product26_window_frame_type) ?></td>
                <td><?= h($quotes->product27_window_frame_type) ?></td>
                <td><?= h($quotes->product28_window_frame_type) ?></td>
                <td><?= h($quotes->product29_window_frame_type) ?></td>
                <td><?= h($quotes->product30_window_frame_type) ?></td>
                <td><?= h($quotes->product1_configuration) ?></td>
                <td><?= h($quotes->product2_configuration) ?></td>
                <td><?= h($quotes->product3_configuration) ?></td>
                <td><?= h($quotes->product4_configuration) ?></td>
                <td><?= h($quotes->product5_configuration) ?></td>
                <td><?= h($quotes->product6_configuration) ?></td>
                <td><?= h($quotes->product7_configuration) ?></td>
                <td><?= h($quotes->product8_configuration) ?></td>
                <td><?= h($quotes->product9_configuration) ?></td>
                <td><?= h($quotes->product10_configuration) ?></td>
                <td><?= h($quotes->product11_configuration) ?></td>
                <td><?= h($quotes->product12_configuration) ?></td>
                <td><?= h($quotes->product13_configuration) ?></td>
                <td><?= h($quotes->product14_configuration) ?></td>
                <td><?= h($quotes->product15_configuration) ?></td>
                <td><?= h($quotes->product16_configuration) ?></td>
                <td><?= h($quotes->product17_configuration) ?></td>
                <td><?= h($quotes->product18_configuration) ?></td>
                <td><?= h($quotes->product19_configuration) ?></td>
                <td><?= h($quotes->product20_configuration) ?></td>
                <td><?= h($quotes->product21_configuration) ?></td>
                <td><?= h($quotes->product22_configuration) ?></td>
                <td><?= h($quotes->product23_configuration) ?></td>
                <td><?= h($quotes->product24_configuration) ?></td>
                <td><?= h($quotes->product25_configuration) ?></td>
                <td><?= h($quotes->product26_configuration) ?></td>
                <td><?= h($quotes->product27_configuration) ?></td>
                <td><?= h($quotes->product28_configuration) ?></td>
                <td><?= h($quotes->product29_configuration) ?></td>
                <td><?= h($quotes->product30_configuration) ?></td>
                <td><?= h($quotes->product1_location_in_building) ?></td>
                <td><?= h($quotes->product2_location_in_building) ?></td>
                <td><?= h($quotes->product3_location_in_building) ?></td>
                <td><?= h($quotes->product4_location_in_building) ?></td>
                <td><?= h($quotes->product5_location_in_building) ?></td>
                <td><?= h($quotes->product6_location_in_building) ?></td>
                <td><?= h($quotes->product7_location_in_building) ?></td>
                <td><?= h($quotes->product8_location_in_building) ?></td>
                <td><?= h($quotes->product9_location_in_building) ?></td>
                <td><?= h($quotes->product10_location_in_building) ?></td>
                <td><?= h($quotes->product11_location_in_building) ?></td>
                <td><?= h($quotes->product12_location_in_building) ?></td>
                <td><?= h($quotes->product13_location_in_building) ?></td>
                <td><?= h($quotes->product14_location_in_building) ?></td>
                <td><?= h($quotes->product15_location_in_building) ?></td>
                <td><?= h($quotes->product16_location_in_building) ?></td>
                <td><?= h($quotes->product17_location_in_building) ?></td>
                <td><?= h($quotes->product18_location_in_building) ?></td>
                <td><?= h($quotes->product19_location_in_building) ?></td>
                <td><?= h($quotes->product20_location_in_building) ?></td>
                <td><?= h($quotes->product21_location_in_building) ?></td>
                <td><?= h($quotes->product22_location_in_building) ?></td>
                <td><?= h($quotes->product23_location_in_building) ?></td>
                <td><?= h($quotes->product24_location_in_building) ?></td>
                <td><?= h($quotes->product25_location_in_building) ?></td>
                <td><?= h($quotes->product26_location_in_building) ?></td>
                <td><?= h($quotes->product27_location_in_building) ?></td>
                <td><?= h($quotes->product28_location_in_building) ?></td>
                <td><?= h($quotes->product29_location_in_building) ?></td>
                <td><?= h($quotes->product30_location_in_building) ?></td>
                <td><?= h($quotes->product1_height) ?></td>
                <td><?= h($quotes->product2_height) ?></td>
                <td><?= h($quotes->product3_height) ?></td>
                <td><?= h($quotes->product4_height) ?></td>
                <td><?= h($quotes->product5_height) ?></td>
                <td><?= h($quotes->product6_height) ?></td>
                <td><?= h($quotes->product7_height) ?></td>
                <td><?= h($quotes->product8_height) ?></td>
                <td><?= h($quotes->product9_height) ?></td>
                <td><?= h($quotes->product10_height) ?></td>
                <td><?= h($quotes->product11_height) ?></td>
                <td><?= h($quotes->product12_height) ?></td>
                <td><?= h($quotes->product13_height) ?></td>
                <td><?= h($quotes->product14_height) ?></td>
                <td><?= h($quotes->product15_height) ?></td>
                <td><?= h($quotes->product16_height) ?></td>
                <td><?= h($quotes->product17_height) ?></td>
                <td><?= h($quotes->product18_height) ?></td>
                <td><?= h($quotes->product19_height) ?></td>
                <td><?= h($quotes->product20_height) ?></td>
                <td><?= h($quotes->product21_height) ?></td>
                <td><?= h($quotes->product22_height) ?></td>
                <td><?= h($quotes->product23_height) ?></td>
                <td><?= h($quotes->product24_height) ?></td>
                <td><?= h($quotes->product25_height) ?></td>
                <td><?= h($quotes->product26_height) ?></td>
                <td><?= h($quotes->product27_height) ?></td>
                <td><?= h($quotes->product28_height) ?></td>
                <td><?= h($quotes->product29_height) ?></td>
                <td><?= h($quotes->product30_height) ?></td>
                <td><?= h($quotes->product1_width) ?></td>
                <td><?= h($quotes->product2_width) ?></td>
                <td><?= h($quotes->product3_width) ?></td>
                <td><?= h($quotes->product4_width) ?></td>
                <td><?= h($quotes->product5_width) ?></td>
                <td><?= h($quotes->product6_width) ?></td>
                <td><?= h($quotes->product7_width) ?></td>
                <td><?= h($quotes->product8_width) ?></td>
                <td><?= h($quotes->product9_width) ?></td>
                <td><?= h($quotes->product10_width) ?></td>
                <td><?= h($quotes->product11_width) ?></td>
                <td><?= h($quotes->product12_width) ?></td>
                <td><?= h($quotes->product13_width) ?></td>
                <td><?= h($quotes->product14_width) ?></td>
                <td><?= h($quotes->product15_width) ?></td>
                <td><?= h($quotes->product16_width) ?></td>
                <td><?= h($quotes->product17_width) ?></td>
                <td><?= h($quotes->product18_width) ?></td>
                <td><?= h($quotes->product19_width) ?></td>
                <td><?= h($quotes->product20_width) ?></td>
                <td><?= h($quotes->product21_width) ?></td>
                <td><?= h($quotes->product22_width) ?></td>
                <td><?= h($quotes->product23_width) ?></td>
                <td><?= h($quotes->product24_width) ?></td>
                <td><?= h($quotes->product25_width) ?></td>
                <td><?= h($quotes->product26_width) ?></td>
                <td><?= h($quotes->product27_width) ?></td>
                <td><?= h($quotes->product28_width) ?></td>
                <td><?= h($quotes->product29_width) ?></td>
                <td><?= h($quotes->product30_width) ?></td>
                <td><?= h($quotes->product1_number_of_locks) ?></td>
                <td><?= h($quotes->product2_number_of_locks) ?></td>
                <td><?= h($quotes->product3_number_of_locks) ?></td>
                <td><?= h($quotes->product4_number_of_locks) ?></td>
                <td><?= h($quotes->product5_number_of_locks) ?></td>
                <td><?= h($quotes->product6_number_of_locks) ?></td>
                <td><?= h($quotes->product7_number_of_locks) ?></td>
                <td><?= h($quotes->product8_number_of_locks) ?></td>
                <td><?= h($quotes->product9_number_of_locks) ?></td>
                <td><?= h($quotes->product10_number_of_locks) ?></td>
                <td><?= h($quotes->product11_number_of_locks) ?></td>
                <td><?= h($quotes->product12_number_of_locks) ?></td>
                <td><?= h($quotes->product13_number_of_locks) ?></td>
                <td><?= h($quotes->product14_number_of_locks) ?></td>
                <td><?= h($quotes->product15_number_of_locks) ?></td>
                <td><?= h($quotes->product16_number_of_locks) ?></td>
                <td><?= h($quotes->product17_number_of_locks) ?></td>
                <td><?= h($quotes->product18_number_of_locks) ?></td>
                <td><?= h($quotes->product19_number_of_locks) ?></td>
                <td><?= h($quotes->product20_number_of_locks) ?></td>
                <td><?= h($quotes->product21_number_of_locks) ?></td>
                <td><?= h($quotes->product22_number_of_locks) ?></td>
                <td><?= h($quotes->product23_number_of_locks) ?></td>
                <td><?= h($quotes->product24_number_of_locks) ?></td>
                <td><?= h($quotes->product25_number_of_locks) ?></td>
                <td><?= h($quotes->product26_number_of_locks) ?></td>
                <td><?= h($quotes->product27_number_of_locks) ?></td>
                <td><?= h($quotes->product28_number_of_locks) ?></td>
                <td><?= h($quotes->product29_number_of_locks) ?></td>
                <td><?= h($quotes->product30_number_of_locks) ?></td>
                <td><?= h($quotes->product1_lock_type) ?></td>
                <td><?= h($quotes->product2_lock_type) ?></td>
                <td><?= h($quotes->product3_lock_type) ?></td>
                <td><?= h($quotes->product4_lock_type) ?></td>
                <td><?= h($quotes->product5_lock_type) ?></td>
                <td><?= h($quotes->product6_lock_type) ?></td>
                <td><?= h($quotes->product7_lock_type) ?></td>
                <td><?= h($quotes->product8_lock_type) ?></td>
                <td><?= h($quotes->product9_lock_type) ?></td>
                <td><?= h($quotes->product10_lock_type) ?></td>
                <td><?= h($quotes->product11_lock_type) ?></td>
                <td><?= h($quotes->product12_lock_type) ?></td>
                <td><?= h($quotes->product13_lock_type) ?></td>
                <td><?= h($quotes->product14_lock_type) ?></td>
                <td><?= h($quotes->product15_lock_type) ?></td>
                <td><?= h($quotes->product16_lock_type) ?></td>
                <td><?= h($quotes->product17_lock_type) ?></td>
                <td><?= h($quotes->product18_lock_type) ?></td>
                <td><?= h($quotes->product19_lock_type) ?></td>
                <td><?= h($quotes->product20_lock_type) ?></td>
                <td><?= h($quotes->product21_lock_type) ?></td>
                <td><?= h($quotes->product22_lock_type) ?></td>
                <td><?= h($quotes->product23_lock_type) ?></td>
                <td><?= h($quotes->product24_lock_type) ?></td>
                <td><?= h($quotes->product25_lock_type) ?></td>
                <td><?= h($quotes->product26_lock_type) ?></td>
                <td><?= h($quotes->product27_lock_type) ?></td>
                <td><?= h($quotes->product28_lock_type) ?></td>
                <td><?= h($quotes->product29_lock_type) ?></td>
                <td><?= h($quotes->product30_lock_type) ?></td>
                <td><?= h($quotes->product1_lock_handle_height) ?></td>
                <td><?= h($quotes->product2_lock_handle_height) ?></td>
                <td><?= h($quotes->product3_lock_handle_height) ?></td>
                <td><?= h($quotes->product4_lock_handle_height) ?></td>
                <td><?= h($quotes->product5_lock_handle_height) ?></td>
                <td><?= h($quotes->product6_lock_handle_height) ?></td>
                <td><?= h($quotes->product7_lock_handle_height) ?></td>
                <td><?= h($quotes->product8_lock_handle_height) ?></td>
                <td><?= h($quotes->product9_lock_handle_height) ?></td>
                <td><?= h($quotes->product10_lock_handle_height) ?></td>
                <td><?= h($quotes->product11_lock_handle_height) ?></td>
                <td><?= h($quotes->product12_lock_handle_height) ?></td>
                <td><?= h($quotes->product13_lock_handle_height) ?></td>
                <td><?= h($quotes->product14_lock_handle_height) ?></td>
                <td><?= h($quotes->product15_lock_handle_height) ?></td>
                <td><?= h($quotes->product16_lock_handle_height) ?></td>
                <td><?= h($quotes->product17_lock_handle_height) ?></td>
                <td><?= h($quotes->product18_lock_handle_height) ?></td>
                <td><?= h($quotes->product19_lock_handle_height) ?></td>
                <td><?= h($quotes->product20_lock_handle_height) ?></td>
                <td><?= h($quotes->product21_lock_handle_height) ?></td>
                <td><?= h($quotes->product22_lock_handle_height) ?></td>
                <td><?= h($quotes->product23_lock_handle_height) ?></td>
                <td><?= h($quotes->product24_lock_handle_height) ?></td>
                <td><?= h($quotes->product25_lock_handle_height) ?></td>
                <td><?= h($quotes->product26_lock_handle_height) ?></td>
                <td><?= h($quotes->product27_lock_handle_height) ?></td>
                <td><?= h($quotes->product28_lock_handle_height) ?></td>
                <td><?= h($quotes->product29_lock_handle_height) ?></td>
                <td><?= h($quotes->product30_lock_handle_height) ?></td>
                <td><?= h($quotes->additional1_item_number) ?></td>
                <td><?= h($quotes->additional2_item_number) ?></td>
                <td><?= h($quotes->additional3_item_number) ?></td>
                <td><?= h($quotes->additional4_item_number) ?></td>
                <td><?= h($quotes->additional5_item_number) ?></td>
                <td><?= h($quotes->additional6_item_number) ?></td>
                <td><?= h($quotes->additional7_item_number) ?></td>
                <td><?= h($quotes->additional8_item_number) ?></td>
                <td><?= h($quotes->additional9_item_number) ?></td>
                <td><?= h($quotes->additional10_item_number) ?></td>
                <td><?= h($quotes->additional1_name) ?></td>
                <td><?= h($quotes->additional2_name) ?></td>
                <td><?= h($quotes->additional3_name) ?></td>
                <td><?= h($quotes->additional4_name) ?></td>
                <td><?= h($quotes->additional5_name) ?></td>
                <td><?= h($quotes->additional6_name) ?></td>
                <td><?= h($quotes->additional7_name) ?></td>
                <td><?= h($quotes->additional8_name) ?></td>
                <td><?= h($quotes->additional9_name) ?></td>
                <td><?= h($quotes->additional10_name) ?></td>
                <td><?= h($quotes->additional1_per_meter) ?></td>
                <td><?= h($quotes->additional2_per_meter) ?></td>
                <td><?= h($quotes->additional3_per_meter) ?></td>
                <td><?= h($quotes->additional4_per_meter) ?></td>
                <td><?= h($quotes->additional5_per_meter) ?></td>
                <td><?= h($quotes->additional6_per_meter) ?></td>
                <td><?= h($quotes->additional7_per_meter) ?></td>
                <td><?= h($quotes->additional8_per_meter) ?></td>
                <td><?= h($quotes->additional9_per_meter) ?></td>
                <td><?= h($quotes->additional10_per_meter) ?></td>
                <td><?= h($quotes->additional1_price) ?></td>
                <td><?= h($quotes->additional2_price) ?></td>
                <td><?= h($quotes->additional3_price) ?></td>
                <td><?= h($quotes->additional4_price) ?></td>
                <td><?= h($quotes->additional5_price) ?></td>
                <td><?= h($quotes->additional6_price) ?></td>
                <td><?= h($quotes->additional7_price) ?></td>
                <td><?= h($quotes->additional8_price) ?></td>
                <td><?= h($quotes->additional9_price) ?></td>
                <td><?= h($quotes->additional10_price) ?></td>
                <td><?= h($quotes->additional1_l_item_number) ?></td>
                <td><?= h($quotes->additional2_l_item_number) ?></td>
                <td><?= h($quotes->additional3_l_item_number) ?></td>
                <td><?= h($quotes->additional4_l_item_number) ?></td>
                <td><?= h($quotes->additional5_l_item_number) ?></td>
                <td><?= h($quotes->additional1_l_name) ?></td>
                <td><?= h($quotes->additional2_l_name) ?></td>
                <td><?= h($quotes->additional3_l_name) ?></td>
                <td><?= h($quotes->additional4_l_name) ?></td>
                <td><?= h($quotes->additional5_l_name) ?></td>
                <td><?= h($quotes->additional1_l_per_length) ?></td>
                <td><?= h($quotes->additional2_l_per_length) ?></td>
                <td><?= h($quotes->additional3_l_per_length) ?></td>
                <td><?= h($quotes->additional4_l_per_length) ?></td>
                <td><?= h($quotes->additional5_l_per_length) ?></td>
                <td><?= h($quotes->additional1_l_price) ?></td>
                <td><?= h($quotes->additional2_l_price) ?></td>
                <td><?= h($quotes->additional3_l_price) ?></td>
                <td><?= h($quotes->additional4_l_price) ?></td>
                <td><?= h($quotes->additional5_l_price) ?></td>
                <td><?= h($quotes->accessory1_item_number) ?></td>
                <td><?= h($quotes->accessory2_item_number) ?></td>
                <td><?= h($quotes->accessory3_item_number) ?></td>
                <td><?= h($quotes->accessory1_each) ?></td>
                <td><?= h($quotes->accessory2_each) ?></td>
                <td><?= h($quotes->accessory3_each) ?></td>
                <td><?= h($quotes->accessory1_name) ?></td>
                <td><?= h($quotes->accessory2_name) ?></td>
                <td><?= h($quotes->accessory3_name) ?></td>
                <td><?= h($quotes->accessory1_price) ?></td>
                <td><?= h($quotes->accessory2_price) ?></td>
                <td><?= h($quotes->accessory3_price) ?></td>
                <td><?= h($quotes->creator_id) ?></td>
                <td><?= h($quotes->product1_cost_dist) ?></td>
                <td><?= h($quotes->product2_cost_dist) ?></td>
                <td><?= h($quotes->product3_cost_dist) ?></td>
                <td><?= h($quotes->product4_cost_dist) ?></td>
                <td><?= h($quotes->product5_cost_dist) ?></td>
                <td><?= h($quotes->product6_cost_dist) ?></td>
                <td><?= h($quotes->product7_cost_dist) ?></td>
                <td><?= h($quotes->product8_cost_dist) ?></td>
                <td><?= h($quotes->product9_cost_dist) ?></td>
                <td><?= h($quotes->product10_cost_dist) ?></td>
                <td><?= h($quotes->product11_cost_dist) ?></td>
                <td><?= h($quotes->product12_cost_dist) ?></td>
                <td><?= h($quotes->product13_cost_dist) ?></td>
                <td><?= h($quotes->product14_cost_dist) ?></td>
                <td><?= h($quotes->product15_cost_dist) ?></td>
                <td><?= h($quotes->product16_cost_dist) ?></td>
                <td><?= h($quotes->product17_cost_dist) ?></td>
                <td><?= h($quotes->product18_cost_dist) ?></td>
                <td><?= h($quotes->product19_cost_dist) ?></td>
                <td><?= h($quotes->product20_cost_dist) ?></td>
                <td><?= h($quotes->product21_cost_dist) ?></td>
                <td><?= h($quotes->product22_cost_dist) ?></td>
                <td><?= h($quotes->product23_cost_dist) ?></td>
                <td><?= h($quotes->product24_cost_dist) ?></td>
                <td><?= h($quotes->product25_cost_dist) ?></td>
                <td><?= h($quotes->product26_cost_dist) ?></td>
                <td><?= h($quotes->product27_cost_dist) ?></td>
                <td><?= h($quotes->product28_cost_dist) ?></td>
                <td><?= h($quotes->product29_cost_dist) ?></td>
                <td><?= h($quotes->product30_cost_dist) ?></td>
                <td><?= h($quotes->product1_cost_wls) ?></td>
                <td><?= h($quotes->product2_cost_wls) ?></td>
                <td><?= h($quotes->product3_cost_wls) ?></td>
                <td><?= h($quotes->product4_cost_wls) ?></td>
                <td><?= h($quotes->product5_cost_wls) ?></td>
                <td><?= h($quotes->product6_cost_wls) ?></td>
                <td><?= h($quotes->product7_cost_wls) ?></td>
                <td><?= h($quotes->product8_cost_wls) ?></td>
                <td><?= h($quotes->product9_cost_wls) ?></td>
                <td><?= h($quotes->product10_cost_wls) ?></td>
                <td><?= h($quotes->product11_cost_wls) ?></td>
                <td><?= h($quotes->product12_cost_wls) ?></td>
                <td><?= h($quotes->product13_cost_wls) ?></td>
                <td><?= h($quotes->product14_cost_wls) ?></td>
                <td><?= h($quotes->product15_cost_wls) ?></td>
                <td><?= h($quotes->product16_cost_wls) ?></td>
                <td><?= h($quotes->product17_cost_wls) ?></td>
                <td><?= h($quotes->product18_cost_wls) ?></td>
                <td><?= h($quotes->product19_cost_wls) ?></td>
                <td><?= h($quotes->product20_cost_wls) ?></td>
                <td><?= h($quotes->product21_cost_wls) ?></td>
                <td><?= h($quotes->product22_cost_wls) ?></td>
                <td><?= h($quotes->product23_cost_wls) ?></td>
                <td><?= h($quotes->product24_cost_wls) ?></td>
                <td><?= h($quotes->product25_cost_wls) ?></td>
                <td><?= h($quotes->product26_cost_wls) ?></td>
                <td><?= h($quotes->product27_cost_wls) ?></td>
                <td><?= h($quotes->product28_cost_wls) ?></td>
                <td><?= h($quotes->product29_cost_wls) ?></td>
                <td><?= h($quotes->product30_cost_wls) ?></td>
                <td><?= h($quotes->product1_cost_re) ?></td>
                <td><?= h($quotes->product2_cost_re) ?></td>
                <td><?= h($quotes->product3_cost_re) ?></td>
                <td><?= h($quotes->product4_cost_re) ?></td>
                <td><?= h($quotes->product5_cost_re) ?></td>
                <td><?= h($quotes->product6_cost_re) ?></td>
                <td><?= h($quotes->product7_cost_re) ?></td>
                <td><?= h($quotes->product8_cost_re) ?></td>
                <td><?= h($quotes->product9_cost_re) ?></td>
                <td><?= h($quotes->product10_cost_re) ?></td>
                <td><?= h($quotes->product11_cost_re) ?></td>
                <td><?= h($quotes->product12_cost_re) ?></td>
                <td><?= h($quotes->product13_cost_re) ?></td>
                <td><?= h($quotes->product14_cost_re) ?></td>
                <td><?= h($quotes->product15_cost_re) ?></td>
                <td><?= h($quotes->product16_cost_re) ?></td>
                <td><?= h($quotes->product17_cost_re) ?></td>
                <td><?= h($quotes->product18_cost_re) ?></td>
                <td><?= h($quotes->product19_cost_re) ?></td>
                <td><?= h($quotes->product20_cost_re) ?></td>
                <td><?= h($quotes->product21_cost_re) ?></td>
                <td><?= h($quotes->product22_cost_re) ?></td>
                <td><?= h($quotes->product23_cost_re) ?></td>
                <td><?= h($quotes->product24_cost_re) ?></td>
                <td><?= h($quotes->product25_cost_re) ?></td>
                <td><?= h($quotes->product26_cost_re) ?></td>
                <td><?= h($quotes->product27_cost_re) ?></td>
                <td><?= h($quotes->product28_cost_re) ?></td>
                <td><?= h($quotes->product29_cost_re) ?></td>
                <td><?= h($quotes->product30_cost_re) ?></td>
                <td><?= h($quotes->midrails_item_number) ?></td>
                <td><?= h($quotes->midrails_quantity) ?></td>
                <td><?= h($quotes->midrails_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->midrails_316_ssgal_pet) ?></td>
                <td><?= h($quotes->midrails_window_or_door) ?></td>
                <td><?= h($quotes->midrails_height) ?></td>
                <td><?= h($quotes->midrails_width) ?></td>
                <td><?= h($quotes->midrails_cost_dist) ?></td>
                <td><?= h($quotes->midrails_cost_wls) ?></td>
                <td><?= h($quotes->midrails_cost_re) ?></td>
                <td><?= h($quotes->midrails_window_frame_type) ?></td>
                <td><?= h($quotes->midrails_configuration) ?></td>
                <td><?= h($quotes->midrails2_item_number) ?></td>
                <td><?= h($quotes->midrails2_quantity) ?></td>
                <td><?= h($quotes->midrails2_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->midrails2_316_ssgal_pet) ?></td>
                <td><?= h($quotes->midrails2_window_or_door) ?></td>
                <td><?= h($quotes->midrails2_height) ?></td>
                <td><?= h($quotes->midrails2_width) ?></td>
                <td><?= h($quotes->midrails2_cost_dist) ?></td>
                <td><?= h($quotes->midrails2_cost_wls) ?></td>
                <td><?= h($quotes->midrails2_cost_re) ?></td>
                <td><?= h($quotes->midrails2_window_frame_type) ?></td>
                <td><?= h($quotes->midrails2_configuration) ?></td>
                <td><?= h($quotes->midrails3_item_number) ?></td>
                <td><?= h($quotes->midrails3_quantity) ?></td>
                <td><?= h($quotes->midrails3_security_dgrille_fibre) ?></td>
                <td><?= h($quotes->midrails3_316_ssgal_pet) ?></td>
                <td><?= h($quotes->midrails3_window_or_door) ?></td>
                <td><?= h($quotes->midrails3_height) ?></td>
                <td><?= h($quotes->midrails3_width) ?></td>
                <td><?= h($quotes->midrails3_cost_dist) ?></td>
                <td><?= h($quotes->midrails3_cost_wls) ?></td>
                <td><?= h($quotes->midrails3_cost_re) ?></td>
                <td><?= h($quotes->midrails3_window_frame_type) ?></td>
                <td><?= h($quotes->midrails3_configuration) ?></td>
                <td><?= h($quotes->installation_total) ?></td>
                <td><?= h($quotes->discount_wh) ?></td>
                <td><?= h($quotes->discount_d) ?></td>
                <td><?= h($quotes->discount_re) ?></td>
                <td><?= h($quotes->markup_wh) ?></td>
                <td><?= h($quotes->markup_d) ?></td>
                <td><?= h($quotes->extra1_qty) ?></td>
                <td><?= h($quotes->extra1_description) ?></td>
                <td><?= h($quotes->extra1_count) ?></td>
                <td><?= h($quotes->extra1_price) ?></td>
                <td><?= h($quotes->extra1_markup) ?></td>
                <td><?= h($quotes->extra2_qty) ?></td>
                <td><?= h($quotes->extra2_description) ?></td>
                <td><?= h($quotes->extra2_count) ?></td>
                <td><?= h($quotes->extra2_price) ?></td>
                <td><?= h($quotes->extra2_markup) ?></td>
                <td><?= h($quotes->extra3_qty) ?></td>
                <td><?= h($quotes->extra3_description) ?></td>
                <td><?= h($quotes->extra3_count) ?></td>
                <td><?= h($quotes->extra3_price) ?></td>
                <td><?= h($quotes->extra3_markup) ?></td>
                <td><?= h($quotes->extra4_qty) ?></td>
                <td><?= h($quotes->extra4_description) ?></td>
                <td><?= h($quotes->extra4_count) ?></td>
                <td><?= h($quotes->extra4_price) ?></td>
                <td><?= h($quotes->extra4_markup) ?></td>
                <td><?= h($quotes->extra5_qty) ?></td>
                <td><?= h($quotes->extra5_description) ?></td>
                <td><?= h($quotes->extra5_count) ?></td>
                <td><?= h($quotes->extra5_price) ?></td>
                <td><?= h($quotes->extra5_markup) ?></td>
                <td><?= h($quotes->extra6_qty) ?></td>
                <td><?= h($quotes->extra6_description) ?></td>
                <td><?= h($quotes->extra6_count) ?></td>
                <td><?= h($quotes->extra6_price) ?></td>
                <td><?= h($quotes->extra6_markup) ?></td>
                <td><?= h($quotes->extra7_qty) ?></td>
                <td><?= h($quotes->extra7_description) ?></td>
                <td><?= h($quotes->extra7_count) ?></td>
                <td><?= h($quotes->extra7_price) ?></td>
                <td><?= h($quotes->extra7_markup) ?></td>
                <td><?= h($quotes->extra8_qty) ?></td>
                <td><?= h($quotes->extra8_description) ?></td>
                <td><?= h($quotes->extra8_count) ?></td>
                <td><?= h($quotes->extra8_price) ?></td>
                <td><?= h($quotes->extra8_markup) ?></td>
                <td><?= h($quotes->extra9_qty) ?></td>
                <td><?= h($quotes->extra9_description) ?></td>
                <td><?= h($quotes->extra9_count) ?></td>
                <td><?= h($quotes->extra9_price) ?></td>
                <td><?= h($quotes->extra9_markup) ?></td>
                <td><?= h($quotes->extra10_qty) ?></td>
                <td><?= h($quotes->extra10_description) ?></td>
                <td><?= h($quotes->extra10_count) ?></td>
                <td><?= h($quotes->extra10_price) ?></td>
                <td><?= h($quotes->extra10_markup) ?></td>
                <td><?= h($quotes->invoice_d_second_1_price) ?></td>
                <td><?= h($quotes->invoice_d_second_2_price) ?></td>
                <td><?= h($quotes->invoice_re_second_1_price) ?></td>
                <td><?= h($quotes->invoice_re_second_2_price) ?></td>
                <td><?= h($quotes->invoice_wh_second_1_price) ?></td>
                <td><?= h($quotes->invoice_wh_second_2_price) ?></td>
                <td><?= h($quotes->invoice_d_second_1_description) ?></td>
                <td><?= h($quotes->invoice_d_second_2_description) ?></td>
                <td><?= h($quotes->invoice_re_second_1_description) ?></td>
                <td><?= h($quotes->invoice_re_second_2_description) ?></td>
                <td><?= h($quotes->invoice_wh_second_1_description) ?></td>
                <td><?= h($quotes->invoice_wh_second_2_description) ?></td>
                <td><?= h($quotes->status) ?></td>
                <td><?= h($quotes->count_additional) ?></td>
                <td><?= h($quotes->check_override_final_d) ?></td>
                <td><?= h($quotes->check_override_final_wh) ?></td>
                <td><?= h($quotes->check_override_final_re) ?></td>
                <td><?= h($quotes->override_final_d) ?></td>
                <td><?= h($quotes->override_final_wh) ?></td>
                <td><?= h($quotes->override_final_re) ?></td>
                <td><?= h($quotes->installation_cost_include_on_check_measure) ?></td>
                <td><?= h($quotes->freight_cost) ?></td>
                <td><?= h($quotes->notes4) ?></td>
                <td><?= h($quotes->markup_d_ss) ?></td>
                <td><?= h($quotes->markup_d_dg) ?></td>
                <td><?= h($quotes->markup_wh_ss) ?></td>
                <td><?= h($quotes->markup_wh_dg) ?></td>
                <td><?= h($quotes->window_door_suite_manufacturer) ?></td>
                <td><?= h($quotes->quoted) ?></td>
                <td><?= h($quotes->printed) ?></td>
                <td><?= h($quotes->send_file_to_manufacturer) ?></td>
                <td><?= h($quotes->mf_role) ?></td>
                <td><?= h($quotes->hidden) ?></td>
                <td><?= h($quotes->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Quotes', 'action' => 'view', $quotes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Quotes', 'action' => 'edit', $quotes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Quotes', 'action' => 'delete', $quotes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $quotes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
