<?php if ($authUser['role'] == 'manufacturer'): ?>

    <div class="panel panel-default panel-border prices-container col-md-3">
        <div class="panel-heading">
            <h3 class="panel-title">Manufacturer</h3>
        </div>
        <div class="panel-body" style="min-height: 100px !important;">
            <table class="table table-no-border total-cost-table">

                <tr>
                    <td>Total Cost:</td>
                    <td><input id="mf-total-cost" type="text" class="form-control input-sm"
                               readonly="readonly"/>
                    </td>
                </tr>

            </table>
        </div>
    </div>

<?php endif; ?>


<div class="panel panel-default panel-border prices-container col-md-4">
    <div class="panel-heading">
        <h3 class="panel-title total-cost-role"></h3>
    </div>
    <div class="panel-body">

        <table class="table table-no-border total-cost-table small-padding">
            <tr>
                <td>Screens Total:</td>
                <td><input id="screens-total" type="text" class="form-control input-sm" readonly="readonly"/>
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>Midrails Total:</td>-->
<!--                <td><input id="midrails-total" type="text" class="form-control input-sm" readonly="readonly">-->
<!--                </td>-->
<!--            </tr>-->
            <tr>
                <td>Sections & Acc Total:</td>
                <td><input id="section-acc-total" type="text" class="form-control input-sm"
                           readonly="readonly"></td>
            </tr>
            <tr>
                <td>Custom Items Total:</td>
                <td><input id="custom-items-total" type="text" class="form-control input-sm"
                           readonly="readonly"></td>
            </tr>
            <tr>
                <td class="font-bold">Total Buy Price:</td>
                <td><input id="total-buy-price" type="text" class="form-control input-sm"
                           readonly="readonly"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>
            <tbody class="markup-section">

            <tr>
                <td class="font-bold SS316">S/S Marked Up %:</td>
                <td class="SS316">

                    <?= $this->Form->input('ss_markup', ['class' => 'form-control input-sm markups-percent', 'label' => false]) ?>

                </td>
            </tr>
            <tr>
                <td class="SS316">SS Marked Up Amount:</td>
                <td class="SS316">
                    <?= $this->Form->input('ss_markup_amount',
                        ['class' => 'form-control input-sm markups-percent', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>

            <tr>
                <td class="font-bold dgrill">DG Marked Up %:</td>
                <td class="dgrill">
                    <?= $this->Form->input('dg_markup', ['class' => 'form-control input-sm markups-percent', 'label' => false]) ?>
                </td>
            </tr>
            <tr>
                <td class="dgrill">DG Marked Up Amount:</td>
                <td class="dgrill">
                    <?= $this->Form->input('dg_markup_amount',
                        ['class' => 'form-control input-sm markups-percent', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>


            <tr>
                <td class="font-bold xceed">Perf Marked Up %:</td>
                <td class="xceed">
                    <?= $this->Form->input('perf_markup', ['class' => 'form-control input-sm markups-percent', 'label' => false]) ?>
                </td>
            </tr>
            <tr>
                <td class="xceed">Perf Marked Up Amount:</td>
                <td class="xceed">
                    <?= $this->Form->input('perf_markup_amount',
                        ['class' => 'form-control input-sm markups-percent', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>

            <tr>
                <td class="font-bold insect">Insect Marked Up %:</td>
                <td class="insect">
                    <?= $this->Form->input('fibr_markup', ['class' => 'form-control input-sm markups-percent', 'label' => false]) ?>
                </td>
            </tr>
            <tr>
                <td class="insect">Insect Marked Up Amount:</td>
                <td class="insect">
                    <?= $this->Form->input('fibr_markup_amount',
                        ['class' => 'form-control input-sm markups-percent', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>
            </tbody>
            <tr>
                <td class="font-bold">Discount %:</td>
                <td>
                    <?= $this->Form->input('discount',
                        ['class' => 'form-control input-sm', 'label' => false]) ?>

                </td>
            </tr>
            <tr>
                <td>Discounted Amount:</td>
                <td>
                    <?= $this->Form->input('discount_amount',
                        ['class' => 'form-control input-sm', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>
            <tr>
                <td>Installation:</td>
                <td><input id="installation-amount" type="text" class="form-control input-sm"
                           readonly="readonly"></td>
            </tr>
            <tr>
                <td class="font-bold" style="color: #171717;">Total Sell Price:</td>
                <td>
                    <?= $this->Form->input('total_sell_price',
                        ['class' => 'form-control input-sm', 'label' => false, 'readonly' => 'readonly', 'style' => 'color: #000;']) ?>
                </td>
            </tr>
            <tr>
                <td>Profit (install not incl.):</td>
                <td>
                    <?= $this->Form->input('profit',
                        ['class' => 'form-control input-sm', 'label' => false, 'readonly' => 'readonly']) ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr class="small-margin">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?= $this->Form->input('override_final_price', ['type' => 'checkbox', 'templates' => [
                        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>
                </td>
            </tr>
            <tr>
                <td style="font-size: 13px;">Custom Quoted Amount:</td>
                <td>
                    <?= $this->Form->input('custom_quoted_amount',
                        ['class' => 'form-control input-sm', 'label' => false,]); ?>
                </td>
            </tr>
        </table>
    </div>
</div>

