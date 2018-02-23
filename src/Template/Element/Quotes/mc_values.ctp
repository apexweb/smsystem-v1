<div class="col-md-4 col-sm-12 mastercalculator-values">

    <?php if ($installation): ?>
        <table class="mcvalues-table table table-bordered grey">
            <tr>
                <th colspan="3">Installation</th>
            </tr>
            <tr>
                <th rowspan="2" class="vertical-middle">S/S, Perf, DG</th>
                <th class="text-center">Window</th>
                <th class="text-center">Door</th>
            </tr>
            <tr>
                <td><span class="ins-ssperfdg-win"><?= h($installation->window_amount); ?></span></td>
                <td><span class="ins-ssperfdg-door"><?= h($installation->door_amount); ?></span></td>
            </tr>
            <tr>
                <th class="vertical-middle">Insect</th>
                <td><span class="ins-insect-win"><?= h($installation->insect_window_amount); ?></span></td>
                <td><span class="ins-insect-door"><?= h($installation->insect_door_amount); ?></span></td>
            </tr>
        </table>
    <?php endif; ?>

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
            <td><span id="sd-deduction"><?= $mcvalues['sd_deduction']; ?></span></td>
            <td><span id="sw-deduction"><?= $mcvalues['sw_deduction']; ?></span></td>
        </tr>
        <tr>
            <th class="grey">D/Grille</th>
            <td><span id="dd-deduction"><?= $mcvalues['dd_deduction']; ?></span></td>
            <td><span id="dw-deduction"><?= $mcvalues['dw_deduction']; ?></span></td>
        </tr>
        <tr>
            <th class="grey">Insect</th>
            <td><span id="id-deduction"><?= $mcvalues['id_deduction']; ?></span></td>
            <td><span id="iw-deduction"><?= $mcvalues['iw_deduction']; ?></span></td>
        </tr>
        <tr>
            <th class="grey">Perf</th>
            <td><span id="pd-deduction"><?= $mcvalues['pd_deduction']; ?></span></td>
            <td><span id="pw-deduction"><?= $mcvalues['pw_deduction']; ?></span></td>
        </tr>
    </table>

    <table class="table table-bordered small-padding">
        <tr>
            <th class="grey vertical-middle text-center" colspan="3">Pet Mesh Price Increasing (%)</th>
        </tr>
        <tr>
            <th>D/Grille / Insect</th>
            <th>Door</th>
            <td>
                <span id="dg-ins-door-infill"><?= h($mcvalues['dg_ins_door_infill']); ?></span>
            </td>
        </tr>
        <tr>
            <th>D/Grille / Insect</th>
            <th>Window</th>
            <td>
                <span id="dg-ins-win-infill"><?= h($mcvalues['dg_ins_win_infill']); ?></span>
            </td>
        </tr>
    </table>

    <table class="mcvalues-table table table-bordered grey">
        <tr>
            <th colspan="4">MASTER MARK UPS from Material Cost - Labour plus Overheads</th>
        </tr>
        <tr>
            <td></td>
            <td style="text-align:center;">Dist.</td>
            <td style="text-align:center;">Whsle.</td>
            <td style="text-align:center;">Retail.</td>

        </tr>
        <tr>
            <th>S/S Hinged and Sliding Doors</th>
            <td><span class="sd-dist"><?= h($mcvalues['sd_dist']) ?></span>%</td>
            <td><span class="sd-whsl"><?= h($mcvalues['sd_whsl']) ?></span>%</td>
            <td><span class="sd-re"><?= h($mcvalues['sd_re']) ?></span>%</td>
        </tr>
        <tr>
            <th>S/S Window Screens</th>
            <td><span class="sw-dist"><?= h($mcvalues['sw_dist']) ?></span>%</td>
            <td><span class="sw-whsl"><?= h($mcvalues['sw_whsl']) ?></span>%</td>
            <td><span class="sw-re"><?= h($mcvalues['sw_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>Perf Hinged and Sliding Doors</th>
            <td><span class="pd-dist"><?= h($mcvalues['pd_dist']) ?></span>%</td>
            <td><span class="pd-whsl"><?= h($mcvalues['pd_whsl']) ?></span>%</td>
            <td><span class="pd-re"><?= h($mcvalues['pd_re']) ?></span>%</td>
        </tr>
        <tr>
            <th>Perf Windows</th>
            <td><span class="pw-dist"><?= h($mcvalues['pw_dist']) ?></span>%</td>
            <td><span class="pw-whsl"><?= h($mcvalues['pw_whsl']) ?></span>%</td>
            <td><span class="pw-re"><?= h($mcvalues['pw_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>DG Hinged and Sliding Doors</th>
            <td><span class="dd-dist"><?= h($mcvalues['dd_dist']) ?></span>%</td>
            <td><span class="dd-whsl"><?= h($mcvalues['dd_whsl']) ?></span>%</td>
            <td><span class="dd-re"><?= h($mcvalues['dd_re']) ?></span>%</td>
        </tr>
        <tr>
            <th>DG Windows</th>
            <td><span class="dw-dist"><?= h($mcvalues['dw_dist']) ?></span>%</td>
            <td><span class="dw-whsl"><?= h($mcvalues['dw_whsl']) ?></span>%</td>
            <td><span class="dw-re"><?= h($mcvalues['dw_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>Insect Hinged and Sliding Doors</th>
            <td><span class="id-dist"><?= h($mcvalues['id_dist']) ?></span>%</td>
            <td><span class="id-whsl"><?= h($mcvalues['id_whsl']) ?></span>%</td>
            <td><span class="id-re"><?= h($mcvalues['id_re']) ?></span>%</td>
        </tr>
        <tr>
            <th>Insect Screens</th>
            <td><span class="iw-dist"><?= h($mcvalues['iw_dist']) ?></span>%</td>
            <td><span class="iw-whsl"><?= h($mcvalues['iw_whsl']) ?></span>%</td>
            <td><span class="iw-re"><?= h($mcvalues['iw_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>Double Sliding Windows</th>
            <td><span class="dsw-dist"><?= h($mcvalues['dsw_dist']) ?></span>%</td>
            <td><span class="dsw-whsl"><?= h($mcvalues['dsw_whsl']) ?></span>%</td>
            <td><span class="dsw-re"><?= h($mcvalues['dsw_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>Inward Opening Escapes [Side & Top Hung]</th>
            <td><span class="ioe-dist"><?= h($mcvalues['ioe_dist']) ?></span>%</td>
            <td><span class="ioe-whsl"><?= h($mcvalues['ioe_whsl']) ?></span>%</td>
            <td><span class="ioe-re"><?= h($mcvalues['ioe_re']) ?></span>%</td>
        </tr>

        <tr>
            <th>Outward Opening Escapes [Side & Top Hung]</th>
            <td><span class="ooe-dist"><?= h($mcvalues['ooe_dist']) ?></span>%</td>
            <td><span class="ooe-whsl"><?= h($mcvalues['ooe_whsl']) ?></span>%</td>
            <td><span class="ooe-re"><?= h($mcvalues['ooe_re']) ?></span>%</td>
        </tr>

    </table>

    <table class="mcvalues-table table table-bordered grey">

        <tr>
            <th colspan="2">Hourly Rate</th>
            <th colspan="3">Contracted Times/Order &amp; Clean up</th>
            <th>Mark up %</th>
        </tr>
        <tr>
            <th>SD</th>
            <td>
                <span class="hrly-sd"><?= h($mcvalues['hrly_sd']) ?></span>
            </td>
            <td>90</td>
            <td>0</td>
            <td>
                <span class="cleanup-sd"><?= h($mcvalues['cleanup_sd']) ?></span>
            </td>
            <td>
                <span class="markup-sd"><?= h($mcvalues['markup_sd']) ?></span>
            </td>
        </tr>
        <tr>
            <th>SW</th>
            <td>
                <span class="hrly-sw"><?= h($mcvalues['hrly_sw']) ?></span>
            </td>
            <td>30</td>
            <td>0</td>
            <td>
                <span class="cleanup-sw"><?= h($mcvalues['cleanup_sw']) ?></span>
            </td>
            <td>
                <span class="markup-sw"><?= h($mcvalues['markup_sw']) ?></span>
            </td>
        </tr>
        <tr>
            <th>DGD</th>
            <td>
                <span class="hrly-dd"><?= h($mcvalues['hrly_dd']) ?></span>
            </td>
            <td></td>
            <td></td>
            <td>
                <span class="cleanup-dd"><?= h($mcvalues['cleanup_dd']) ?></span>
            </td>
            <td>
                <span class="markup-dd"><?= h($mcvalues['markup_dd']) ?></span>
            </td>
        </tr>
        <tr>
            <th>DGW</th>
            <td>
                <span class="hrly-dw"><?= h($mcvalues['hrly_dw']) ?></span>
            </td>
            <td></td>
            <td></td>
            <td>
                <span class="cleanup-dw"><?= h($mcvalues['cleanup_dw']) ?></span>
            </td>
            <td>
                <span class="markup-dw"><?= h($mcvalues['markup_dw']) ?></span>
            </td>
        </tr>
        <tr>
            <th>FD</th>
            <td>
                <span class="hrly-fd"><?= h($mcvalues['hrly_fd']) ?></span>
            </td>
            <td></td>
            <td></td>
            <td>
                <span class="cleanup-fd"><?= h($mcvalues['cleanup_fd']) ?></span>
            </td>
            <td>
                <span class="markup-fd"><?= h($mcvalues['markup_fd']) ?></span>
            </td>
        </tr>
        <tr>
            <th>FW</th>
            <td>
                <span class="hrly-fw"><?= h($mcvalues['hrly_fw']) ?></span>
            </td>
            <td></td>
            <td></td>
            <td>
                <span class="cleanup-fw"><?= h($mcvalues['cleanup_fw']) ?></span>
            </td>
            <td>
                <span class="markup-fw"><?= h($mcvalues['markup_fw']) ?></span>
            </td>
        </tr>
        <tr>
            <th>PD</th>
            <td>
                <span class="hrly-pd"><?= h($mcvalues['hrly_pd']) ?></span>
            </td>
            <td>90</td>
            <td>0</td>
            <td>
                <span class="cleanup-pd"><?= h($mcvalues['cleanup_pd']) ?></span>
            </td>
            <td>
                <span class="markup-pd"><?= h($mcvalues['markup_pd']) ?></span>
            </td>
        </tr>
        <tr>
            <th>PW</th>
            <td>
                <span class="hrly-pw"><?= h($mcvalues['hrly_pw']) ?></span>
            </td>
            <td>30</td>
            <td>0</td>
            <td>
                <span class="cleanup-pw"><?= h($mcvalues['cleanup_pw']) ?></span>
            </td>
            <td>
                <span class="markup-pw"><?= h($mcvalues['markup_pw']) ?></span>
            </td>
        </tr>

    </table>

    <table class="table table-no-border">

        <tr style="background:#99ccff;">
            <td rowspan="8" style="vertical-align: middle;">Powder Coating<br>(per Item)</td>
            <td></td>
            <td>Window</td>
            <td>Door</td>
        </tr>
        <tr style="background:#99ccff;">
            <td>Std</td>
            <td>
                <?= h($mcvalues['std']) ?>
            </td>
            <td>
                <?= h($mcvalues['std']) ?>
            </td>

        </tr>
        <tr style="background:#99ccff;">
            <td>Custom Colour</td>
            <td class="custom-color-win">
                <?= h($mcvalues['custom_color_win']) ?>
            </td>
            <td class="custom-color-door">
                <?= h($mcvalues['custom_color_door']) ?>
            </td>
        </tr>
        <tr style="background:#99ccff;">
            <td>Premium Colour</td>
            <td class="pr-color-win">
                <?= h($mcvalues['pr_color_win']) ?>
            </td>
            <td class="pr-color-door">
                <?= h($mcvalues['pr_color_door']) ?>
            </td>
        </tr>
        
        <tr style="background:#99ccff;">
            <td>Anodized</td>
            <td class="anodized-color-win">
                <?= h($mcvalues['anodized_color_win']) ?>
            </td>
            <td class="anodized-color-door">
                <?= h($mcvalues['anodized_color_door']) ?>
            </td>
        </tr>
        
        <tr style="background:#99ccff;">
            <td>Special Colour</td>
            <td class="special-color-win">
                <?= h($mcvalues['special_color_win']) ?>
            </td>
            <td class="special-color-door">
                <?= h($mcvalues['special_color_door']) ?>
            </td>
        </tr>

    </table>
    <table class="table table-bordered mcvalues-table small-padding">
        <tr>
            <th class="grey" colspan="2">Lock Pricing Deductions (No Lock)</th>
        </tr>
        <tr>
            <th class="grey">Single Lock</th>
            <td class="mc-list-1"><?= h($mcvalues['single_lock']); ?></td>
        </tr>
        <tr>
            <th class="grey">Triple Lock</th>
            <td class="mc-list-2"><?= h($mcvalues['triple_lock']); ?></td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr class="">
            <th class="grey">Include Midrail</th>
            <td>
                <span class="inc-midrail-amount"><?= h($mcvalues['include_midrail_amount']); ?></span>
            </td>
        </tr>
    </table>
</div>