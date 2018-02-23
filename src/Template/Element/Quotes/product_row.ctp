<tr id="product-options-row-<?php echo $i; ?>" class="product-options-row">
    <?= $this->Form->hidden('products.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('products.' . $i . '.product_item_number',
            ['label' => false, 'class' => 'form-control product-item-no product-options']); ?>
    </td>

    <td>

        <?= $this->Form->input(
            'products.' . $i . '.product_qty',
            /*[1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],*/
            ['empty' => ' ', 'label' => false, 'type' => 'number',
                'class' => 'product-options form-control product-qty', 'data-style' => 'btn-primary']
        );
        ?>

    </td>
    <td>

        <?= $this->Form->select(
            'products.' . $i . '.product_sec_dig_perf_fibr',
            ['316 S/S' => '316 S/S', 'Perf' => 'Perf', 'D/Grille' => 'D/Grille', 'Insect' => 'Insect'],
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options form-control product-sec-dg-fibr',
                'data-style' => 'btn-primary',
                'data-prev' => ''
            ]
        );
        ?>

    </td>

    <td>

        <?= $this->Form->select(
            'products.' . $i . '.product_316_ss_gal_pet',
            ['Fibre' => 'Fibre', 'Pet Mesh' => 'Pet Mesh'],
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options form-control product-ss-gal-pet', 'data-style' => 'btn-primary']
        );
        ?>

    </td>
    
    <td>
        <?= $this->Form->select(
            'products.' . $i . '.product_colour',
            $colours,
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options form-control product-colour', 'data-style' => 'btn-primary']
        );
        ?>
    </td>

  <td>

        <?= $this->Form->select(
            'products.' . $i . '.product_window_or_door',
            ['Window' => 'Window', 'Door' => 'Door'],
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options form-control product-win-door', 'data-style' => 'btn-primary']
        );
        ?>

    </td>

    <td>

        <?= $this->Form->select(
            'products.' . $i . '.product_window_frame_type',
            ['9mm' => '9mm', '11mm' => '11mm'],
            ['empty' => ' ', 'label' => false, 'class' => 'form-control product-frame-type', 'data-style' => 'btn-primary']
        );
        ?>

    </td>



    <td>

        <select name="<?= 'products[' . $i . '][product_configuration]' ?>" class="form-control product-options product-conf" data-style="btn-primary">
            <option value=""></option>
            <?php foreach ($conf as $item): ?>
                <option <?php if($item['text'] == $selected) {echo 'selected="selected"';}?> data-code="<?= $item['code']; ?>" value="<?= $item['text']; ?>"><?= $item['text']; ?></option>
            <?php endforeach; ?>
        </select>

    </td>

    <td>
        <?= $this->Form->input('products.' . $i . '.product_location_in_building', ['label' => false, 'class' => 'form-control product_location_in_building']); ?>
    </td>

    <td>
        <?= $this->Form->input('products.' . $i . '.product_height',
            ['label' => false, 'class' => 'product-options form-control product-height']); ?>
    </td>

    <td>
        <?= $this->Form->input('products.' . $i . '.product_width',
            ['label' => false, 'class' => 'product-options form-control product-width']); ?>
    </td>

    <td>
        <?= $this->Form->select(
            'products.' . $i . '.product_lock_qty',
            [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options form-control product-lock-qty', 'data-style' => 'btn-primary']
        );
        ?>
    </td>

    <td>

        <?= $this->Form->select(
            'products.' . $i . '.product_lock_type',
            ['Single' => 'Single', 'Triple' => 'Triple'],
            ['empty' => ' ', 'label' => false,
                'class' => 'product-options product-lock-type form-control', 'data-style' => 'btn-primary']
        );
        ?>

    </td>

    <td>
        <?= $this->Form->input('products.' . $i . '.product_lock_handle_height',
            ['label' => false, 'class' => 'product-options form-control product-lock-height']); ?>
    </td>
    <td>
        <button style="visibility: hidden;" type="button"
                class="delete-btn product-delete"><i class="typcn typcn-delete"></i>
        </button>
    </td>
    <?= $this->Form->input('products.' . $i . '.product_incorporate_install',
        ['type' => 'hidden','class' => 'product_incorporate_install',])
    ?>
</tr>

<tr id="product-prices-row-<?php echo $i; ?>" class="product-prices-row">
    <td colspan="15">
        <div class="value-holder">
            <span class="product-mf-role"></span>

            <?= $this->Form->input('products.' . $i . '.product_cost',
                ['templates' => ['inputContainer' => '{{content}}'],
                    'class' => 'span-input product-price-incl-gst', 'readonly' => 'readonly', 'label' => false,
                    'style' => 'font-weight: 400;']); ?>

            <!--            <input class="price-incl-gst-not-emergency" type="hidden">-->
        </div>
        <div class="value-holder">Sell:
            <input class="span-input product-sell-price" readonly="readonly">
        </div>
        <div class="value-holder">Profit:
            <input class="span-input product-profit" readonly="readonly">
        </div>
        <div class="value-holder" style="float: right;">


            <div class="alert alert-warning inc-midrail-alert" style="float: left;">
                This Screen will be supplied with a Midrail.
            </div>

<!--            <button type="button"-->
<!--                    class="copy-to-midrail-btn btn btn-white btn-custom btn-rounded waves-effect btn-small">-->
<!--                Copy to Midrail-->
<!--            </button>-->


            <?= $this->Form->input('products.' . $i . '.product_inc_midrail',
                ['type' => 'checkbox',
                    'class' => 'product-inc-midrail',
                    'label' => 'Include Midrail',
                    'templates' => [
                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>',
                        'inputContainer' => '<div class="input inline-block {{type}}{{required}}">{{content}}</div>',]])
            ?>
        </div>
    </td>
</tr>
