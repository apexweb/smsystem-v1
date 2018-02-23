<tr id="midrail-options-row-<?php echo $i; ?>" class="midrail-options-row">
    <?= $this->Form->hidden('midrails.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('midrails.' . $i . '.midrail_item_number', ['label' => false, 'class' => 'form-control product-item-no midrail-item-no']); ?>
    </td>

    <td>

        <?= $this->Form->select(
            'midrails.' . $i . '.midrail_qty',
            [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            ['empty' => ' ', 'label' => false, 'class' => 'form-control midrail-qty midrail-options', 'data-style' => 'btn-primary']
        );
        ?>

    </td>
    <td>

        <?= $this->Form->select(
            'midrails.' . $i . '.midrail_sec_dig_perf_fibr',
            ['316 S/S' => '316 S/S'],
            ['empty' => ' ', 'label' => false, 'class' => 'form-control midrail-sec-dg-fibr midrail-options', 'data-style' => 'btn-primary']
        );
        ?>

    </td>

    <td>

        <?= $this->Form->select(
            'midrails.' . $i . '.midrail_window_or_door',
            ['Window' => 'Window'],
            ['empty' => ' ', 'label' => false, 'class' => 'form-control midrail-win-door midrail-options', 'data-style' => 'btn-primary']
        );
        ?>

    </td>

    <td>

        <?= $this->Form->select(
            'midrails.' . $i . '.midrail_type',
            [
                'Double Sliding Window' => 'Sliding',
                'Inward Opening Escapes [Side & Top Hung]' => 'Inward Open',
                'Outward Opening Escapes [Side & Top Hung]' => 'Outward Open',
            ],
            ['empty' => ' ', 'label' => false, 'class' => 'form-control midrail-type midrail-options', 'data-style' => 'btn-primary']
        );
        ?>

    </td>


    <td>
        <?= $this->Form->input('midrails.' . $i . '.midrail_height', ['label' => false, 'class' => 'form-control midrail-height midrail-options']); ?>
    </td>

    <td>
        <?= $this->Form->input('midrails.' . $i . '.midrail_width', ['label' => false, 'class' => 'form-control midrail-width midrail-options']); ?>
    </td>

    <td>
        <button style="visibility: hidden;" type="button"
                class="delete-btn midrail-delete"><i class="typcn typcn-delete"></i>
        </button>
    </td>

</tr>

<tr id="midrail-prices-row-<?php echo $i; ?>" class="midrail-prices-row">
    <td colspan="10">
        <div class="value-holder">
            <span class="midrail-mf-role">Dist.:</span>
<!--            <input class="span-input midrail-price-incl-gst" readonly="readonly">-->

            <?= $this->Form->input('midrails.' . $i . '.midrail_cost',
                ['templates' => ['inputContainer' => '{{content}}'] ,
                    'class' => 'span-input midrail-price-incl-gst', 'readonly' => 'readonly', 'label' => false]); ?>

        </div>
    </td>
</tr>