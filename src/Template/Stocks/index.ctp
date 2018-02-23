<h1>
    <small>Combined Stocks</small>
</h1>

<div class="card-box">

    <div class="row">
        <div class="col-md-2 col-md-offset-10 col-sm-offset-0">
            <?= $this->Form->create($this, ['type' => 'GET', 'class' => 'search-form']); ?>
            <?= $this->Form->select(
                'status',
                ['' => 'All', 'inactive' => 'Inactive',
                    'active' => 'Active'],
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'value' => $status]
            );
            ?>


            <?= $this->Form->end(); ?>
        </div>

        <div class="col-md-6">


            <table class="table table-bordered table-hover">
                <tr class="grey">
                    <th>Combined Stock #</th>
                    <th>Created on</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($stocks as $stock): ?>

                    <tr>
                        <td class="text-center font-15">
                            <span>
                                <?= $this->Html->link(
                                    h($stock->id),
                                    ['action' => 'view', $stock->id],
                                    ['class' => 'primary', 'style' => 'text-decoration: underline;']
                                ); ?>
                            </span>
                        </td>
                        <td><?= h($stock->created->format('d/m/Y H:m:i')); ?></td>
                        <td class="text-capitalize">
                            <p class="no-margin"><?= h($stock->status); ?></p>
                            <?php if ($stock->status == 'active'): ?>
                                <?= $this->Form->postLink('Mark as Inactive', ['action' => 'markasinactive', $stock->id],
                                    ['confirm' => 'Are you sure?']) ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $stock->id], ['confirm' => 'Are you sure?']) ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div> <!-- .row -->
</div>

<?= $this->Html->script('quote-index.js', ['block' => 'script']); ?>