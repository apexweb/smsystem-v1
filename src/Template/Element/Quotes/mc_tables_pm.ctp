<?php
    //pr($mc_parts);
    
    $part_vaiables = [
            'singleLockSld' => ['label' => isset($mc_parts['SNGLOCKSLD']['title'])?$mc_parts['SNGLOCKSLD']['title']:'', 'price' => isset($mc_parts['SNGLOCKSLD']['price'])?$mc_parts['SNGLOCKSLD']['price']:''],
            'singleLockHng' => ['label' => isset($mc_parts['SNGLOCKHNG']['title'])?$mc_parts['SNGLOCKHNG']['title']:'', 'price' => isset($mc_parts['SNGLOCKHNG']['price'])?$mc_parts['SNGLOCKHNG']['price']:''],
            'tripleLockSld' => ['label' => isset($mc_parts['TRPLOCKSLD']['title'])?$mc_parts['TRPLOCKSLD']['title']:'', 'price' => isset($mc_parts['TRPLOCKSLD']['price'])?$mc_parts['TRPLOCKSLD']['price']:''],
            'tripleLockHng' => ['label' => isset($mc_parts['TRPLOCKHNG']['title'])?$mc_parts['TRPLOCKHNG']['title']:'', 'price' => isset($mc_parts['TRPLOCKHNG']['price'])?$mc_parts['TRPLOCKHNG']['price']:''],
            'spline' => ['label' => isset($mc_parts['INSSPLN']['title'])?$mc_parts['INSSPLN']['title']:'', 'price' => isset($mc_parts['INSSPLN']['price'])?$mc_parts['INSSPLN']['price']:''],
            'insectMesh' => ['label' => isset($mc_parts['INSMSH']['title'])?$mc_parts['INSMSH']['title']:'', 'price' => isset($mc_parts['INSMSH']['price'])?$mc_parts['INSMSH']['price']:''],
            'petMesh' => ['label' => isset($mc_parts['INSPETMSH']['title'])?$mc_parts['INSPETMSH']['title']:'', 'price' => isset($mc_parts['INSPETMSH']['price'])?$mc_parts['INSPETMSH']['price']:''],
            'PVCLSeat' => ['label' => isset($mc_parts['SECDRWDGPT2']['title'])?$mc_parts['SECDRWDGPT2']['title']:'', 'price' => isset($mc_parts['SECDRWDGPT2']['price'])?$mc_parts['SECDRWDGPT2']['price']:''],
            'PVCWedge' => ['label' => isset($mc_parts['SECDRWDGPT1']['title'])?$mc_parts['SECDRWDGPT1']['title']:'', 'price' => isset($mc_parts['SECDRWDGPT1']['price'])?$mc_parts['SECDRWDGPT1']['price']:''],
            'sgSSMesh' => ['label' => isset($mc_parts['SSMESH']['title'])?$mc_parts['SSMESH']['title']:'', 'price' => isset($mc_parts['SSMESH']['price'])?$mc_parts['SSMESH']['price']:''],
            'perfSheetFixingBead' => ['label' => isset($mc_parts['PERFWEG']['title'])?$mc_parts['PERFWEG']['title']:'', 'price' => isset($mc_parts['PERFWEG']['price'])?$mc_parts['PERFWEG']['price']:''],
            'roller' => ['label' => isset($mc_parts['ROLLR']['title'])?$mc_parts['ROLLR']['title']:'', 'price' => isset($mc_parts['ROLLR']['price'])?$mc_parts['ROLLR']['price']:''],
            'hingers' => ['label' => isset($mc_parts['HNG']['title'])?$mc_parts['HNG']['title']:'', 'price' => isset($mc_parts['HNG']['price'])?$mc_parts['HNG']['price']:''], 
            'rollerHinges' => ['label' => isset($mc_parts['HNG']['title'])?$mc_parts['HNG']['title']:'', 'price' => isset($mc_parts['HNG']['price'])?$mc_parts['HNG']['price']:''], 
            'lockCyl' => ['label' => isset($mc_parts['LCKCYL']['title'])?$mc_parts['LCKCYL']['title']:'', 'price' => isset($mc_parts['LCKCYL']['price'])?$mc_parts['LCKCYL']['price']:''], 
        ];
    
    $secDoor = [
            'secdigfibr' => 'Security',
            'windoor' => 'Door',
            //'sqmpart' => ['label' => 'SG S/S mesh', 'price' => '75.6', 'color' => ''],
            'sqmpart' => ['label' => isset($mc_parts['SSMESH']['title'])?$mc_parts['SSMESH']['title']:'', 'price' => isset($mc_parts['SSMESH']['price'])?$mc_parts['SSMESH']['price']:'', 'color' => ''],
            'frame' => ['label' => isset($mc_parts['SECDRFRM']['title'])?$mc_parts['SECDRFRM']['title']:'', 'price' => isset($mc_parts['SECDRFRM']['price'])?$mc_parts['SECDRFRM']['price']:'', 'color' => ''],
            'crnstake' => ['label' => isset($mc_parts['SECDRCRNSTK']['title'])?$mc_parts['SECDRCRNSTK']['title']:'', 'price' => isset($mc_parts['SECDRCRNSTK']['price'])?$mc_parts['SECDRCRNSTK']['price']:'', 'color' => '']                   
        ];

    $secWindow = [
            'secdigfibr' => 'Security',
            'windoor' => 'Windows',
            'sqmpart' => ['label' => isset($mc_parts['SSMESH']['title'])?$mc_parts['SSMESH']['title']:'', 'price' => isset($mc_parts['SSMESH']['price'])?$mc_parts['SSMESH']['price']:'', 'color' => ''],
            'frame' => [
                    'default' => ['label' => isset($mc_parts['SECWNFRM9']['title'])?$mc_parts['SECWNFRM9']['title']:'', 'price' => isset($mc_parts['SECWNFRM9']['price'])?$mc_parts['SECWNFRM9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['SECWNFRM9']['title'])?$mc_parts['SECWNFRM9']['title']:'', 'price' => isset($mc_parts['SECWNFRM9']['price'])?$mc_parts['SECWNFRM9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['SECWNFRM11']['title'])?$mc_parts['SECWNFRM11']['title']:'', 'price' => isset($mc_parts['SECWNFRM11']['price'])?$mc_parts['SECWNFRM11']['price']:'', 'color' => ''],
                    ],
            'crnstake' => [
                    'default' => ['label' => isset($mc_parts['SECWNCRNSTK9']['title'])?$mc_parts['SECWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK9']['price'])?$mc_parts['SECWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['SECWNCRNSTK9']['title'])?$mc_parts['SECWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK9']['price'])?$mc_parts['SECWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['SECWNCRNSTK11']['title'])?$mc_parts['SECWNCRNSTK11']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK11']['price'])?$mc_parts['SECWNCRNSTK11']['price']:'', 'color' => ''],
                    ],
        ] ;

    $dgDoor = [
            'secdigfibr' => 'Diamond Grille',
            'windoor' => 'Door',
            'sqmpart' => ['label' => isset($mc_parts['7MMDG']['title'])?$mc_parts['7MMDG']['title']:'', 'price' => isset($mc_parts['7MMDG']['price'])?$mc_parts['7MMDG']['price']:'', 'color' => ''],
            'frame' => ['label' => isset($mc_parts['DGDRFRM']['title'])?$mc_parts['DGDRFRM']['title']:'', 'price' => isset($mc_parts['DGDRFRM']['price'])?$mc_parts['DGDRFRM']['price']:'', 'color' => ''],
            'crnstake' => ['label' => isset($mc_parts['DGDRCRNSTK']['title'])?$mc_parts['DGDRCRNSTK']['title']:'', 'price' => isset($mc_parts['DGDRCRNSTK']['price'])?$mc_parts['DGDRCRNSTK']['price']:'', 'color' => '']                   
        ];

    $dgWindow = [
            'secdigfibr' => 'Diamond Grille',
            'windoor' => 'Windows',
            'sqmpart' => ['label' => isset($mc_parts['7MMDG']['title'])?$mc_parts['7MMDG']['title']:'', 'price' => isset($mc_parts['7MMDG']['price'])?$mc_parts['7MMDG']['price']:'', 'color' => ''],
            'frame' => [
                    'default' => ['label' => isset($mc_parts['DGWNFRM9']['title'])?$mc_parts['DGWNFRM9']['title']:'', 'price' => isset($mc_parts['DGWNFRM9']['price'])?$mc_parts['DGWNFRM9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['DGWNFRM9']['title'])?$mc_parts['DGWNFRM9']['title']:'', 'price' => isset($mc_parts['DGWNFRM9']['price'])?$mc_parts['DGWNFRM9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['DGWNFRM11']['title'])?$mc_parts['DGWNFRM11']['title']:'', 'price' => isset($mc_parts['DGWNFRM11']['price'])?$mc_parts['DGWNFRM11']['price']:'', 'color' => ''],
                    ],
            'crnstake' => [
                    'default' => ['label' => isset($mc_parts['DGWNCRNSTK9']['title'])?$mc_parts['DGWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['DGWNCRNSTK9']['price'])?$mc_parts['DGWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['DGWNCRNSTK9']['title'])?$mc_parts['DGWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['DGWNCRNSTK9']['price'])?$mc_parts['DGWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['DGWNCRNSTK11']['title'])?$mc_parts['DGWNCRNSTK11']['title']:'', 'price' => isset($mc_parts['DGWNCRNSTK11']['price'])?$mc_parts['DGWNCRNSTK11']['price']:'', 'color' => ''],
                    ],
        ] ;

    $fibrDoor = [
            'secdigfibr' => 'Fibre',
            'windoor' => 'Doors',
            'sqmpart' => [
                        'petmesh' => ['label' => isset($mc_parts['INSPETMSH']['title'])?$mc_parts['INSPETMSH']['title']:'', 'price' => isset($mc_parts['INSPETMSH']['title'])?$mc_parts['INSPETMSH']['title']:'', 'color' => ''],
                        'mesh' => ['label' => isset($mc_parts['INSMSH']['title'])?$mc_parts['INSMSH']['title']:'', 'price' => isset($mc_parts['INSMSH']['price'])?$mc_parts['INSMSH']['price']:'', 'color' => ''],
                     ],
            'frame' => ['label' => isset($mc_parts['INSDRFRM']['title'])?$mc_parts['INSDRFRM']['title']:'', 'price' => isset($mc_parts['INSDRFRM']['price'])?$mc_parts['INSDRFRM']['price']:'', 'color' => ''],
            'crnstake' => ['label' => isset($mc_parts['INSDRCRNSTK']['title'])?$mc_parts['INSDRCRNSTK']['title']:'', 'price' => isset($mc_parts['INSDRCRNSTK']['price'])?$mc_parts['INSDRCRNSTK']['price']:'', 'color' => '']                   
        ];

    $fibrWindow = [
            'secdigfibr' => 'Fibre',
            'windoor' => 'Windows',
            'sqmpart' => [
                        'petmesh' => ['label' => isset($mc_parts['INSPETMSH']['title'])?$mc_parts['INSPETMSH']['title']:'', 'price' => isset($mc_parts['INSPETMSH']['title'])?$mc_parts['INSPETMSH']['title']:'', 'color' => ''],
                        'mesh' => ['label' => isset($mc_parts['INSMSH']['title'])?$mc_parts['INSMSH']['title']:'', 'price' => isset($mc_parts['INSMSH']['price'])?$mc_parts['INSMSH']['price']:'', 'color' => ''],
                    ],
            'frame' => [
                    'default' => ['label' => isset($mc_parts['INSWNFRM9']['title'])?$mc_parts['INSWNFRM9']['title']:'', 'price' => isset($mc_parts['INSWNFRM9']['price'])?$mc_parts['INSWNFRM9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['INSWNFRM9']['title'])?$mc_parts['INSWNFRM9']['title']:'', 'price' => isset($mc_parts['INSWNFRM9']['price'])?$mc_parts['INSWNFRM9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['INSWNFRM11']['title'])?$mc_parts['INSWNFRM11']['title']:'', 'price' => isset($mc_parts['INSWNFRM11']['price'])?$mc_parts['INSWNFRM11']['price']:'', 'color' => ''],
                    ],
            'crnstake' => [
                    'default' => ['label' => isset($mc_parts['INSWNCRNSTK9']['title'])?$mc_parts['INSWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['INSWNCRNSTK9']['price'])?$mc_parts['INSWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['INSWNCRNSTK9']['title'])?$mc_parts['INSWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['INSWNCRNSTK9']['price'])?$mc_parts['INSWNCRNSTK9']['price']:'', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['INSWNCRNSTK11']['title'])?$mc_parts['INSWNCRNSTK11']['title']:'', 'price' => isset($mc_parts['INSWNCRNSTK11']['price'])?$mc_parts['INSWNCRNSTK11']['price']:'', 'color' => ''],
                    ],
        ] ;
    
    $perfDoor = [
            'secdigfibr' => 'Perforated Aluminium',
            'windoor' => 'Door',
            'sqmpart' => ['label' => isset($mc_parts['PERFMESH']['title'])?$mc_parts['PERFMESH']['title']:'', 'price' => isset($mc_parts['PERFMESH']['price'])?$mc_parts['PERFMESH']['price']:'', 'color' => ''],
            'frame' => ['label' => isset($mc_parts['SECDRFRM']['title'])?$mc_parts['SECDRFRM']['title']:'', 'price' => isset($mc_parts['SECDRFRM']['price'])?$mc_parts['SECDRFRM']['price']:'5.37', 'color' => ''],
            'crnstake' => ['label' => isset($mc_parts['SECDRCRNSTK']['title'])?$mc_parts['SECDRCRNSTK']['title']:'', 'price' => isset($mc_parts['SECDRCRNSTK']['price'])?$mc_parts['SECDRCRNSTK']['price']:'0.69', 'color' => '']                   
        ];
    
    $perfWindow = [
            'secdigfibr' => 'Perforated Aluminium',
            'windoor' => 'Windows',
            'sqmpart' => ['label' => isset($mc_parts['PERFMESH']['title'])?$mc_parts['PERFMESH']['title']:'', 'price' => isset($mc_parts['PERFMESH']['price'])?$mc_parts['PERFMESH']['price']:'', 'color' => ''],
            'frame' => [
                    'default' => ['label' => isset($mc_parts['SECWNFRM9']['title'])?$mc_parts['SECWNFRM9']['title']:'', 'price' => isset($mc_parts['SECWNFRM9']['price'])?$mc_parts['SECWNFRM9']['price']:'2.93', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['SECWNFRM9']['title'])?$mc_parts['SECWNFRM9']['title']:'', 'price' => isset($mc_parts['SECWNFRM9']['price'])?$mc_parts['SECWNFRM9']['price']:'2.93', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['SECWNFRM11']['title'])?$mc_parts['SECWNFRM11']['title']:'', 'price' => isset($mc_parts['SECWNFRM11']['price'])?$mc_parts['SECWNFRM11']['price']:'2.93', 'color' => ''],
                    ],
            'crnstake' => [
                    'default' => ['label' => isset($mc_parts['SECWNCRNSTK9']['title'])?$mc_parts['SECWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK9']['price'])?$mc_parts['SECWNCRNSTK9']['price']:'0.51', 'color' => ''],
                    'mm9' => ['label' => isset($mc_parts['SECWNCRNSTK9']['title'])?$mc_parts['SECWNCRNSTK9']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK9']['price'])?$mc_parts['SECWNCRNSTK9']['price']:'0.51', 'color' => ''],
                    'mm11' => ['label' => isset($mc_parts['SECWNCRNSTK11']['title'])?$mc_parts['SECWNCRNSTK11']['title']:'', 'price' => isset($mc_parts['SECWNCRNSTK11']['price'])?$mc_parts['SECWNCRNSTK11']['price']:'0.51', 'color' => ''],
                    ],
        ] ;
?>
<input class="mc-product-matrix" data-name="secDoor" data-table="secDoor" type="hidden"
                   value="<?= htmlspecialchars(json_encode($secDoor)); ?>">

<input class="mc-product-matrix" data-name="secWindow" data-table="secWindow" type="hidden"
                   value="<?= htmlspecialchars(json_encode($secWindow)); ?>">

<input class="mc-product-matrix" data-name="dgDoor" data-table="dgDoor" type="hidden"
                   value="<?= htmlspecialchars(json_encode($dgDoor)); ?>">

<input class="mc-product-matrix" data-name="dgWindow" data-table="dgWindow" type="hidden"
                   value="<?= htmlspecialchars(json_encode($dgWindow)); ?>">

<input class="mc-product-matrix" data-name="fibrDoor" data-table="fibrDoor" type="hidden"
                   value="<?= htmlspecialchars(json_encode($fibrDoor)); ?>">

<input class="mc-product-matrix" data-name="fibrWindow" data-table="fibrWindow" type="hidden"
                   value="<?= htmlspecialchars(json_encode($fibrWindow)); ?>">

<input class="mc-product-matrix" data-name="perfDoor" data-table="perfDoor" type="hidden"
                   value="<?= htmlspecialchars(json_encode($perfDoor)); ?>">

<input class="mc-product-matrix" data-name="perfWindow" data-table="perfWindow" type="hidden"
                   value="<?= htmlspecialchars(json_encode($perfWindow)); ?>">

<input class="mc-product-matrix" data-name="partVariables" data-table="partVariables" type="hidden"
                   value="<?= htmlspecialchars(json_encode($part_vaiables)); ?>">



<div class="col-md-7 col-sm-12 mastercalculator-tables">

    <div id="products-mc-container" class="col-md-12">
        <div class="col-md-6 col-sm-8 product-mc-container">
            <table class="table mastercalculator text-center table-no-border" id="product-mc-0"
                   style="display: none;">
                <tbody>
                <tr class="secdigfibr-container">
                    <td style="color:#ffffff;" colspan="4">
                        <span class="product-mc-secdigfibr"></span>
                    </td>
                </tr>
                <tr class="windoor-container">
                    <td style="color:#ffffff;" colspan="2">
                        <span class="product-mc-windoor"></span>
                    </td>
                    <td style="background:#99ccff; color:#000000;">Pwd Coat</td>
                    <td><span class="product-pwdcoat-spec-1"></span></td>
                </tr>
                <tr>
                    <td style="background:#00ff00;"><span class="product-height"></span></td>
                    <td style="background:#ffff00;"><span class="product-width"></span></td>
                    <td style="background:#99ccff; color:#000000;"><span
                            class="product-coat"></span>
                    </td>
                    <td><span class="product-pwdcoat-spec-2"></span></td>
                </tr>
                <tr>
                    <td>Mesh (H)</td>
                    <td>Mesh (W)</td>
                    <td>L/Mtrs</td>
                    <td><span class="product-pwdcoat-spec-3"></span></td>
                </tr>
                <tr>
                    <td style="background:#00ff00;"><span class="product-mesh-height"></span></td>
                    <td style="background:#ffff00;"><span class="product-mesh-width"></span></td>
                    <td style="background:#ffcc99; color:#000000;"><span
                            class="product-lmtrs"></span>
                    </td>
                    <td><span class="product-pwdcoat-spec-4"></span></td>
                </tr>
                <tr>
                    <td style="background:#33cccc; color:#000000;">SqM</td>
                    <td style="background:#33cccc; color:#000000;"><span
                            class="product-sqm"></span>
                    </td>
                    <td style="background:#99ccff; color:#000000;">$/SqM</td>
                    <td style="background:#99ccff; color:#000000;"><span
                            class="product-sqm-calculated"></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="background:#ffcc99; color:#000000;">
                        <span class="product-winframe-name"></span>
                    </td>
                    <td style="background:#ffcc99; color:#000000;"><span
                            class="product-winframe-price"></span>
                    </td>
                    <td style="background:#ffcc99; color:#000000;"><span
                            class="product-winframe-calculated"></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="background:#ff99cc; color:#000000;">
                        <span class="product-win-cnrstake-name"></span>
                    </td>
                    <td style="background:#ff99cc; color:#000000;"><span
                            class="product-win-cnrstake-price">
                                    </span></td>
                    <td style="background:#ff99cc; color:#000000;"><span
                            class="product-win-cnrstake-calculated"></span>
                    </td>
                </tr>


                <tr class="pvc-row">
                    <td colspan="2" style="background:#ccffcc; color:#000000;"><span class="product-pvc-wedge-name">PVC Wedge</span></td>
                    <td style="background:#ccffcc; color:#000000;">
                        <span class="product-pvc-wedge-price"></span>
                    </td>
                    <td style="background:#ccffcc; color:#000000;">
                        <span class="product-pvc-wedge-calculated"></span>
                    </td>
                </tr>
                <tr class="lseat-row">
                    <td colspan="2" style="background:#cc99ff; color:#000000;"><span class="product-lseat-name">L-Seat</span></td>
                    <td style="background:#cc99ff; color:#000000;">
                        <span class="product-lseat-price"></span></td>
                    <td style="background:#cc99ff; color:#000000;"><span
                            class="product-lseat-calculated"></span>
                    </td>
                </tr>

                <tr class="spline-row" style="display: none;">
                    <td colspan="2" style="background:#ccffcc; color:#000000;"><span class="product-spline-name">Spline</span></td>
                    <td style="background:#ccffcc; color:#000000;"><span
                            class="product-spline"></span></td>
                    <td style="background:#ccffcc; color:#000000;"><span
                            class="product-spline-calculated"></span></td>
                </tr>

                <tr class="insect-mesh-row" style="display: none;">
                    <td></td>
                    <td colspan="2" style="background:#DA9694; color:#000000;">Insect Mesh
                    </td>
                    <td style="background:#ffff99; color:#000000;">
                        <span class="product-insect-mesh"></span>
                    </td>
                </tr>

                <tr class="perf-sheet-row" style="display: none;">
                    <td colspan="2" style="background:#ddd3ff; color:#000000;">Perforated Sheet
                        Fixing
                        Bead
                    </td>
                    <td style="background:#ddd3ff; color:#000000;"><span
                            class="product-perf-sheet-fixing"></span>
                    </td>
                    <td style="background:#ddd3ff; color:#000000;"><span
                            class="product-perf-sheet-fixing-calculated"></span>
                    </td>
                </tr>

                <tr class="components-row" style="display: none;">
                    <td colspan="2" style="background:#99ccff; color:#000000;">
                        Components-Wheels/Hinges
                    </td>
                    <td style="background:#99ccff; color:#000000;"><span
                            class="product-components-wheels-hinges"</span>
                    </td>
                    <td style="background:#99ccff; color:#000000;"><span class="product-components-wheels-hinges-calculated"></span>
                    </td>
                </tr>
                <!--                            <tr>-->
                <!--                                <td colspan="4"></td>-->
                <!--                            </tr>-->
                <tr>
                    <td></td>
                    <td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables
                    </td>
                    <td style="background:#ffff99; color:#000000;">
                        <span class="product-freight-consumables"></span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Material Cost</td>
                    <td><span class="product-material-cost"></span></td>
                </tr>
                <tr>
                    <td colspan="3" style="background:#afafaf; color:#000000;">Labour
                        incl./Cutting
                    </td>
                    <td style="background:#afafaf; color:#000000;">
                        <span class="product-labour-incl-cutting"></span>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Total Cost</td>
                    <td><span class="product-total-cost"></span></td>
                </tr>
                <tr style="display: none;">
                    <td>Increase</td>
                    <td></td>
                    <td></td>
                    <td><span class="product-cost-markedup"></span></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-md-2 col-sm-4 product-mc-res-container">
            <table class="product-result" id="product-result-0" style="display: none;">
                <tbody>
                <tr>
                    <td><strong>Cost</strong></td>
                    <td><span class="product-result-cost"></span></td>
                </tr>
                <tr>
                    <td><strong>Quantity</strong></td>
                    <td><span class="product-result-quantity"></span></td>
                </tr>
                <tr>
                    <td><strong>Locks</strong></td>
                    <td><span class="product-result-locks"></span></td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><span class="product-result-total"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div id="midrails-mc-container" class="col-md-12">

        <div class="col-md-6 col-sm-8 midrail-mc-container">
            <table id="midrail-mc-0" class="table mastercalculator text-center table-no-border"
                   style="display: none;">
                <tbody>
                <tr class="secdgfibr-container">
                    <td style="color:#ffffff;" colspan="4">
                        <span class="midrail-mc-secdgfibr"></span>
                    </td>
                </tr>
                <tr class="windoor-container">
                    <td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
                    <td style="color:#ffffff;" width="75%" colspan="3">
                        <span class="midrail-mc-windoor"></span>
                    </td>
                </tr>
                <tr>
                    <td style="background:#99ccff; color:#000000;">
                        <span class="midrail-pwdcoat-spec-1"></span>
                    </td>
                    <td style="background:#99ccff; color:#000000;">
                        <span class="midrail-pwdcoat-spec-2"></span>
                    </td>
                    <td style="background:#99ccff; color:#000000;">
                        <span class="midrail-pwdcoat-spec-3"></span>
                    </td>
                    <td style="background:#99ccff; color:#000000;">
                        <span class="midrail-pwdcoat-spec-4">0.00</span>
                    </td>


                </tr>
                <tr>
                    <td colspan="3">Time Allocated/mins</td>
                    <td><span class="midrail-mc-time-allocated-min"></span></td>

                </tr>
                <tr>
                    <td>Rail (W)</td>
                    <td style="background:#ffff00;">
                        <span class="midrail-mc-width">2000</span></td>
                    <td>Mark Up</td>
                    <td><span class="midrail-mc-markup"></span>%</td>

                </tr>
                <tr>
                    <td style="background:#33cccc; color:#000000;">L/M</td>
                    <td style="background:#99ccff; color:#000000;">
                        <span class="midrail-mc-lm"></span></td>
                    <td style="background:#ffff99; color:#000000;">Consumables</td>
                    <td style="background:#ffff99; color:#000000;">
                        <span class="mr-mc-consumables"></span></td>

                </tr>
                <tr class="item-1-row">
                    <td colspan="2" style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-1-name"></span>
                    </td>
                    <td style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-1">5.7</span>
                    </td>
                    <td style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-1-calculated">11.40</span></td>

                </tr>
                <tr class="item-2-row">
                    <td colspan="2" style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-2-name">4.8</span>
                    </td>
                    <td style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-2">2.43</span></td>
                    <td style="background:#ffcc99; color:#000000;">
                        <span class="midrail-mc-item-2-calculated">4.86</span></td>

                </tr>
                <tr class="item-3-row">
                    <td colspan="2" style="background:#ccffcc; color:#000000;">
                        <span class="midrail-mc-item-3-name">4.8</span>
                    </td>
                    <td style="background:#ccffcc; color:#000000;">
                        <span class="midrail-mc-item-3">4.8</span>
                    </td>
                    <td style="background:#ccffcc; color:#000000;">
                        <span class="midrail-mc-item-3-calculated">19.20</span></td>

                </tr>

                <tr>
                    <td></td>
                    <td colspan="2">Material Cost</td>
                    <td><span class="midrail-mc-material-cost"></span></td>

                </tr>
                <tr>
                    <td colspan="3" style="background:#afafaf; color:#000000;">Labour
                        incl./Cutting
                    </td>
                    <td style="background:#afafaf; color:#000000;">
                        <span class="midrail-mc-labour-incl-cutting"></span></td>

                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Total Cost</td>
                    <td><span class="midrail-mc-total-cost"></span></td>
                </tr>
                <tr style="display:none;">
                    <td>Increase</td>
                    <td></td>
                    <td></td>
                    <td>
                        <span class="midrail-mc-cost-markedup"></span>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>


        <div class="col-md-2 col-sm-4 midrail-mc-res-container">
            <table class="table-no-border midrail-result"
                   id="midrail-result-0" style="display: none;">

                <tbody>
                <tr>
                    <td><strong>Cost</strong></td>
                    <td><span class="midrail-mc-result-cost"></span></td>
                </tr>
                <tr>
                    <td><strong>Quantity</strong></td>
                    <td><span class="midrail-mc-result-quantity"></span></td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><span class="midrail-mc-result-total"></span></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>


    <div class="col-xs-12 font-12" style="display:none;">

        <?php foreach ($matrixTables as $table): ?>


            <?php if (isset($table->prices[0]->pricePerMesure)): ?>
                <input class="price-per-measures" data-name="<?= $table->name ?>" type="hidden"
                       value="<?= htmlspecialchars($table->prices[0]->pricePerMesure); ?>">
            <?php endif; ?>

            <input class="midrail-inc" data-table="<?= $table->name ?>" type="hidden"
                   value="<?= htmlspecialchars($table->midrail_requirement); ?>">

            <table class="table matrix-table small-padding table-responsive" data-table="<?= $table->name ?>">
                <caption class="table-name-caption"><?= $table->name ?> Prices</caption>
            </table>


        <?php endforeach; ?>

    </div>
