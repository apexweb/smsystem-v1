<div
    style="font-size: 14px; color: #4f4f4f; font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    <p>Hello, A new order has received.</p>
    <p>Order No.: <strong><?= $quote->qId; ?></strong></p>
    <p>Order in Date: <strong><?php if ($quote->orderin_date) echo $quote->orderin_date; ?></strong></p>
    <p>Required Date: <strong><?php if ($quote->required_date) echo $quote->required_date; ?></strong></p>
    <p>Customer Name: <strong><?= $quote->customer_name; ?></strong></p>
</div>