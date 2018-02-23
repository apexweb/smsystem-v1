<h1>
    <small>Master Calculator Values</small>
</h1>

<div class="card-box">

    <?= $this->Form->create($mcvalue, ['class' => 'form-inline']) ?>
    <div class="row font-13">
        <div class="col-md-4">


            <table class="mcvalues-table table table-bordered small-padding">
                <tr class="grey">
                    <th colspan="2">Hourly Rate</th>
                    <th colspan="3">Contracted Times/Order&amp;Clean up</th>
                    <th>Mark up %</th>
                </tr>
                <tr>
                    <th class="grey">SD</th>
                    <td>
                        <?= $this->Form->input('hrly_sd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>90</td>
                    <td>0</td>
                    <td>
                        <?= $this->Form->input('cleanup_sd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_sd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">SW</th>
                    <td>
                        <?= $this->Form->input('hrly_sw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>30</td>
                    <td>0</td>
                    <td>
                        <?= $this->Form->input('cleanup_sw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_sw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">DGD</th>
                    <td>
                        <?= $this->Form->input('hrly_dd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?= $this->Form->input('cleanup_dd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_dd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">DGW</th>
                    <td>
                        <?= $this->Form->input('hrly_dw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?= $this->Form->input('cleanup_dw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_dw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">InD</th>
                    <td>
                        <?= $this->Form->input('hrly_fd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?= $this->Form->input('cleanup_fd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_fd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">InW</th>
                    <td>
                        <?= $this->Form->input('hrly_fw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?= $this->Form->input('cleanup_fw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_fw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">XCD</th>
                    <td>
                        <?= $this->Form->input('hrly_pd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>90</td>
                    <td>0</td>
                    <td>
                        <?= $this->Form->input('cleanup_pd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_pd', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">XCW</th>
                    <td>
                        <?= $this->Form->input('hrly_pw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>30</td>
                    <td>0</td>
                    <td>
                        <?= $this->Form->input('cleanup_pw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('markup_pw', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
            </table>


            <table class="table table-bordered mcvalues-table small-padding">
                <tr>
                    <th class="grey" colspan="2">Lock Pricing Deductions (No Lock)</th>
                </tr>
                <tr>
                    <th class="grey">Single Lock</th>
                    <td><?= $this->Form->input('single_lock', ['class' => 'form-control input-sm', 'label' => '']) ?></td>
                </tr>
                <tr>
                    <th class="grey">Triple Lock</th>
                    <td><?= $this->Form->input('triple_lock', ['class' => 'form-control input-sm', 'label' => '']) ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table mcvalues-table table-bordered small-padding master-markup-table">
                <tr class="grey">
                    <th colspan="4">MASTER MARK UPS from Material Cost - Labour plus Overheads</th>
                </tr>
                <tr class="grey">
                    <th></th>
                    <th>Dist.</th>
                    <th>Whsle.</th>
                    <th>Retail.</th>
                </tr>
                <tr>
                    <th class="grey">S/S Hinged and Sliding Doors</th>
                    <td>
                        <?= $this->Form->input('sd_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('sd_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('sd_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>
                <tr>
                    <th class="grey">S/S Window Screens</th>
                    <td>
                        <?= $this->Form->input('sw_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('sw_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('sw_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Perf Hinged and Sliding Doors</th>
                    <td>
                        <?= $this->Form->input('pd_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('pd_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('pd_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Perf Windows</th>
                    <td>
                        <?= $this->Form->input('pw_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('pw_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('pw_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">DG Hinged and Sliding Doors</th>
                    <td>
                        <?= $this->Form->input('dd_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('dd_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('dd_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">DG Windows</th>
                    <td>
                        <?= $this->Form->input('dw_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('dw_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('dw_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Insect Hinged and Sliding Doors</th>
                    <td>
                        <?= $this->Form->input('id_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('id_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('id_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Insect Screens</th>
                    <td>
                        <?= $this->Form->input('iw_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('iw_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('iw_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>


                <tr>
                    <th class="grey">Double Sliding Windows</th>
                    <td>
                        <?= $this->Form->input('dsw_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('dsw_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('dsw_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Inward Opening Escapes [Side & Top Hung]</th>
                    <td>
                        <?= $this->Form->input('ioe_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('ioe_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('ioe_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>

                <tr>
                    <th class="grey">Outward Opening Escapes [Side & Top Hung]</th>
                    <td>
                        <?= $this->Form->input('ooe_dist', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('ooe_whsl', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                    <td>
                        <?= $this->Form->input('ooe_re', ['class' => 'form-control input-sm', 'label' => false]) ?>

                    </td>
                </tr>
            </table>

        </div>


        <div class="col-md-4">
            <table class="mcvalues-table table table-bordered small-padding">
                <tr>
                    <th class="grey" rowspan="8">Powder Coating<br>(per Item)</th>
                    <td class="grey"></td>
                    <th class="grey">Window</th>
                    <th class="grey">Door</th>
                </tr>
                <tr>
                    <th class="grey">Std</th>
                    <td>
                        <?= $this->Form->input('std', ['class' => 'form-control input-sm', 'label' => false, 'readonly' => 'readonly']) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('std', ['class' => 'form-control input-sm', 'label' => false, 'readonly' => 'readonly']) ?>
                    </td>

                </tr>
                <tr>
                    <th class="grey">Custom Colour</th>
                    <td>
                        <?= $this->Form->input('custom_color_win', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('custom_color_door', ['class' => 'form-control input-sm autonumber', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">Premium Colour</th>
                    <td>
                        <?= $this->Form->input('pr_color_win', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('pr_color_door', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">Anodized</th>
                    <td>
                        <?= $this->Form->input('anodized_color_win', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('anodized_color_door', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th class="grey">Special Colour</th>
                    <td>
                        <?= $this->Form->input('special_color_win', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                    <td>
                        <?= $this->Form->input('special_color_door', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
            </table>

            <table class="table table-bordered small-padding">
                <tr>
                    <th class="grey vertical-middle">Include Midrail Amount:</th>
                    <td class="text-center">
                        <?= $this->Form->input('include_midrail_amount', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
            </table>

            <table class="table table-bordered small-padding">
                <tr>
                    <th class="grey vertical-middle text-center" colspan="3">Pet Mesh Price Increasing (%)</th>
                </tr>
                <tr>
                    <th>D/Grille / Insect </th>
                    <th>Door</th>
                    <td>
                        <?= $this->Form->input('dg_ins_door_infill', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
                <tr>
                    <th>D/Grille / Insect </th>
                    <th>Window</th>
                    <td>
                        <?= $this->Form->input('dg_ins_win_infill', ['class' => 'form-control input-sm', 'label' => false]) ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-md-4">
            <table class="table table-bordered small-padding mcvalues-table">
                <tr>
                    <th colspan="3" class="grey">Mesh Deductions</th>
                </tr>
                <tr class="grey">
                    <th></th>
                    <th>Door</th>
                    <th>Window</th>
                </tr>
                <tr>
                    <th class="grey">316 S/S</th>
                    <td><?= $this->Form->input('sd_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('sw_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                </tr>
                <tr>
                    <th class="grey">D/Grille</th>
                    <td><?= $this->Form->input('dd_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('dw_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                </tr>
                <tr>
                    <th class="grey">Insect</th>
                    <td><?= $this->Form->input('id_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('iw_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                </tr>
                <tr>
                    <th class="grey">Perf</th>
                    <td><?= $this->Form->input('pd_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                    <td><?= $this->Form->input('pw_deduction', ['class' => 'form-control input-sm', 'label' => false]) ?></td>
                </tr>
            </table>
        </div>


        <div class="col-xs-12">
            <?= $this->Form->Button('Update Calculator', ['class' => 'btn btn-success waves-effect']) ?>
        </div>


    </div><!-- .row -->
    <?= $this->Form->end(); ?>

</div>