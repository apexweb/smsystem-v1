<tr id="additional-l-row-<?= $i ?>">
    <?= $this->Form->hidden('additionalperlength.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('additionalperlength.' . $i . '.additional_item_number', ['label' => false, 'class' => 'form-control additional-per-length product-item-no']); ?>
    </td>

    <td>

        <?= $this->Form->input('additionalperlength.' . $i . '.additional_per_length', ['type' => 'number', 'label' => false, 'class' => 'form-control additional-per-length additional-length width-80']); ?>

    </td>
    <td>

        <?= $this->Form->input(
            'additionalperlength.' . $i . '.additional_name',
            [
                'type' => 'select',
                'multiple' => false,
                'options' => $additional_per_length,
                'empty' => true,
                'label' => false,
                'class' => 'form-control additional-per-length additional-name'
            ]
        ); ?>

    </td>
    <td>

        <?= $this->Form->input('additionalperlength.' . $i . '.additional_price',
            ['label' => false, 'class' => 'form-control additional-total-price span-input', 'readonly' => 'readonly']); ?>

    </td>

    <td>
        <?= $this->Form->input('additionalperlength.' . $i . '.additional_markup',
            ['label' => false, 'class' => 'form-control additional-per-length additional-markup']); ?>

    </td>
    
    <td class="width-75">

        <?= $this->Form->input('additionalperlength.' . $i . '.additional_charged',
            ['label' => false, 'class' => 'form-control span-input additional-charged', 'readonly' => 'readonly', 'style'=>'font-weight:bold; text-align:center !important;']); ?>

    </td>

    <td class="width-10">
        <button style="visibility: hidden;" type="button"
                class="delete-btn addtional-l-delete"><i class="typcn typcn-delete"></i>
        </button>
    </td>


</tr>