<h1><small><?= __('All Content') ?></small></h1>

<div class="card-box users font-13">

    <table class="table table-bordered small-padding table-responsive">
        <thead>
            <tr>
                <th scope="col" class="col-md-2"><?= $this->Paginator->sort('label') ?></th>
                <th scope="col" class="col-md-3"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col" class="col-md-6"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions col-md-1"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contents as $content): ?>
            <tr>
                <td><?= h($content->label) ?></td>
                <td><?= h($content->title) ?></td>
                <td><?php echo ($this->Text->excerpt($content->description, 'method', 250, '...')); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $content->id]) ?>
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
