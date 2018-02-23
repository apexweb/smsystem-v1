<tr id="accesorry-row-<?= $i ?>">
    <?= $this->Form->hidden('accessories.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('accessories.' . $i . '.accessory_item_number', ['label' => false, 'class' => 'form-control product-item-no accessories']); ?>
    </td>

    <td>
        <?= $this->Form->input('accessories.' . $i . '.accessory_each', ['label' => false, 'class' => 'form-control product-item-no accessories accessory-each']); ?>
    </td>

    <td>

        <?= $this->Form->input(
            'accessories.' . $i . '.accessory_name',
            [
                'type' => 'select',
                'multiple' => false,
                'options' => $accessories,
                'empty' => true,
                'label' => false,
                'class' => 'form-control accessories accessory-name'
            ]
        ); ?>


    </td>
    <td>

        <?= $this->Form->input('accessories.' . $i . '.accessory_price',
            ['label' => false, 'class' => 'form-control accessories accessory-total-price span-input', 'readonly' => 'readonly']); ?>

    </td>
    <td>
        <?= $this->Form->input('accessories.' . $i . '.accessory_markup',
            ['label' => false, 'class' => 'form-control accessories accessory-markup']); ?>

    </td>
    
    <td class="width-75">

        <?= $this->Form->input('accessories.' . $i . '.accessory_charged',
            ['label' => false, 'class' => 'form-control span-input accessory-charged', 'readonly' => 'readonly', 'style'=>'font-weight:bold; text-align:center !important;']); ?>

    </td>


</tr>