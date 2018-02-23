<?php
    $invoice_no = 'A';

    for ($i=1; $i<=5; $i++) {
        if (rand(0,1)) {
            // letter
            $invoice_no .= chr(rand(65, 90));
        } else {
            // number;
            $invoice_no .= rand(0, 9);
        }
    }    
?>
<div class="row">

    <div class="col-sm-11">
        <h1>
            <small>MF Monthly Fee Report</small>
        </h1>
    </div>
    <div class="col-sm-1 text-right-not-xs">

        <?=
        $this->Html->link($this->Html->image('/assets/images/pdficon.png', ['alt' => 'PDF']),
            ['controller' => 'Quotes', 'action' => 'monthlyreportpdf', $user_id.'.pdf', 
            '?' => array('month' => $month, 'year' => $year)],
            ['class' => 'pdflink', 'escape' => false]);
        ?>
    </div>
    <?= $this->element('Quotes/calendar_form', ['year' => $year, 'month' => $month]); ?>
    
</div>



<div class="row">

    <div class="col-md-10 col-md-offset-1 col-sm-offset-0 font-13">
        
        <?php
        if ($quotes->count() >0) {
            $invoice_amount_sum = 0;
            foreach($quotes as $quote) {
                $total = $quote->invoiceCost;

                $flagSecurity = false;

                if ($flagSecurity) {
                    $total = (float)$total + 8;
                }

                $additiona1 = $quote['invoice_second_1_price'];
                $additiona2 = $quote['invoice_second_2_price'];

                $final = round($total + $additiona1 + $additiona2, 0);
                $invoice_amount_sum += $final;
            }
            $usage_fee_percentage = 0;
            switch($invoice_amount_sum) {
                case $invoice_amount_sum <= 10000:
                    $usage_fee_percentage = 1.4;
                break;
                case $invoice_amount_sum <= 25000:
                    $usage_fee_percentage = 1.0;
                break;
                case $invoice_amount_sum <= 50000:
                    $usage_fee_percentage = 0.8;
                break;
                case $invoice_amount_sum <= 75000:
                    $usage_fee_percentage = 0.6;
                break;
                case $invoice_amount_sum > 75000:
                    $usage_fee_percentage = 0.5;
                break;

            }
        ?>
        <table class="table table-responsive invoice-table table-bordered">

            <tr class="darklight-greyborder">
                <th class="light-grey">Order Date</th>
                <th class="light-grey">Wholesaler/Dist Name</th>
                <th class="light-grey">Customer Name</th>
                <th class="light-grey">Order No.</th>
                <th class="light-grey">Status</th>
                <th class="light-grey">Invoice Amount</th>
                <th class="light-grey">%<?= h($usage_fee_percentage);?></th>                
            </tr>
            <?php 
            $invoice_amount_sum = 0;
            $usage_fee_sum = 0;
            foreach($quotes as $quote) { 
               $total = $quote->invoiceCost;

               $flagSecurity = false;

               if ($flagSecurity) {
                   $total = (float)$total + 8;
               }

               $additiona1 = $quote['invoice_second_1_price'];
               $additiona2 = $quote['invoice_second_2_price'];


               $final = round($total + $additiona1 + $additiona2, 0);
                
               $invoice_amount_sum += $final;

               //Funnel Web %2:
               $funnel_web = round($final * $usage_fee_percentage / 100, 2);
               $usage_fee_sum += $funnel_web;
           ?>
            <tr>
                <td class="text-center"><?= h($quote->orderin_date) ?></td>
                <td class="text-center"><?= h($quote->user->business_name) ?></td>
                <td class="text-center"><?= h($quote->customer_name) ?></td>
                <td class="text-center"><?= h($quote->qId) ?></td>
                <td class="text-center"><?= h($quote->status) ?></td>
                <td class="text-center"><strong><span>$</span><span id="total-cost"><?= $total; ?></span></strong></td>
                <td class="text-center"><strong><span>$</span><span><?= $funnel_web; ?></span></strong></td>                
            </tr>
            
            <?php }?>

            <tr class="darklight-greyborder">
                <th class="light-grey" colspan="5">Total</th>      
                <th class="light-grey text-center"><strong><span>$</span><span id="total-cost"><?= $invoice_amount_sum; ?></span></strong></th>          
                <th class="light-grey text-center"><strong><span>$</span><span id="total-cost"><?= $usage_fee_sum; ?></span></strong></th>           
            </tr>
           
            
        </table>     
        <?php }else{
            echo 'No report data available for this period.';
        }?>
        
    </div>
</div>


