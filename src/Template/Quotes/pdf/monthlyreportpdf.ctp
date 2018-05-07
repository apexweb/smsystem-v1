<?php use Cake\Routing\Router;?>
<?php
    /*$invoice_no = 'A';

    for ($i=1; $i<=5; $i++) {
        if (rand(0,1)) {
            // letter
            $invoice_no .= chr(rand(65, 90));
        } else {
            // number;
            $invoice_no .= rand(0, 9);
        }
    }*/    

	$url = Router::url('/assets/files/FWInvoice.jpg', true);
	if ($stream = fopen($url, 'r')) {
	
	}
?>

<div class="card-box printout">
        <div class="text-center" style="margin-bottom: 5px;">

            <img class="img-responsive" style="width:100%;" src="data:image/png;base64,'<?= base64_encode(stream_get_contents($stream)); ?> '" alt="Printout Header Image" >
        </div>
</div>
<div class="row" class="noborder">
    <table class="table table-responsive invoice-table table-bordered">
        <tr class="noborder">
            <td width="40%" class="noborder">
                <div class="col-md-4 col-md-offset-1 col-sm-offset-0 font-13">
                    <table class="table table-responsive">
                        <tr><td><h3>Bill To:</h3></td></tr>
                        <tr><td><?= $user->business_name ?></td></tr>   
						<tr><td><?= $user->business_address ?></td></tr>  
                    </table>
                </div>
            </td>
            <td width="20%" class="noborder"></td>
            <td width="40%" class="noborder">
                <div class="col-md-4 col-md-offset-2 col-sm-offset-0 font-13">
                    <table class="table table-responsive invoice-table table-bordered">
                        <tr><td><h3>Tax Invoice:</h3></td></tr>
                        <tr>
                            <td>Date: <?= h(date('d/m/Y'));?>
                                <br/>
                                Invoice #: <?= h(str_pad($invoice_no,5,"0",STR_PAD_LEFT));?>   
                            </td></tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>


<div class="row">

    <div class="col-md-10 col-sm-offset-0 font-13">
        
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

<div class="row">

    <div class="col-md-4 col-sm-offset-0 font-13">
        <table class="table table-responsive invoice-table table-bordered">
            <tr><td><h3>PAYMENT DETAILS</h3></td></tr>
            <tr><td>
                <address>
                <strong>Name: Apex Web Design Pty Ltd.</strong><br>
				Bank: Bank of Queensland<br>
                BSB: 124-001<br>
                Acc No. 22267993                
              </address>               
        </td></tr>            
        </table>
		<!-- <table class="table table-responsive invoice-table table-bordered">
            <tr>
				<td><h3>Address</h3></td>
			</tr>
            <tr>
				<td>
					<address>
					<?= $user->business_address ?>               
				  </address>               
				</td>
			</tr>            
        </table> -->
    </div>  

</div>

<style>
 .col-md-offset-1 {
    margin-left: 8.33333333%;
}

.invoice-table {
    margin-bottom: 20px !important;
}
.col-md-offset-2 {
    margin-left: 16.66666667%;
}

</style>
