<tr id="customitem-row-<?= $i ?>">
    <?= $this->Form->hidden('customitems.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('customitems.' . $i . '.custom_qty',
            ['label' => false, 'class' => 'form-control product-item-no custom-items custom-item-qty']); ?>
    </td>

    <td>
        <?= $this->Form->input('customitems.' . $i . '.custom_description', ['label' => false, 'class' => 'form-control']); ?>

    </td>

    <td>
        <?= $this->Form->input('customitems.' . $i . '.custom_tick',
            ['type' => 'checkbox', 'class' => 'checkbox-single custom-items custom-item-tick',
                'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label style="position: absolute;"></label>']]); ?>
    </td>

    <td>
        <?= $this->Form->input('customitems.' . $i . '.custom_price',
            ['label' => false, 'class' => 'form-control custom-items custom-item-price']); ?>

    </td>
    <td>

        <?= $this->Form->input('customitems.' . $i . '.custom_markup',
            ['label' => false, 'class' => 'form-control custom-items custom-item-markup']); ?>


    </td>
    <td class="width-50">

        <?= $this->Form->input('customitems.' . $i . '.custom_charged',
            ['label' => false, 'class' => 'form-control span-input custom-item-charged', 'readonly' => 'readonly']); ?>

    </td>

    <td class="width-10">
        <button style="visibility: hidden;" type="button"
                class="delete-btn customitem-delete"><i class="typcn typcn-delete"></i>
        </button>
    </td>


</tr>