<div class="card-box">
<?php 
$role = $authUser['role'];
if ($content) { ?>
    <h1><?= h($content->title);?> 
    
        <?php 
            if ($role == 'manufacturer'): ?>
                <small style="float:right;font-size:12px;">
                <?php echo $this->Html->link('Edit', ['controller' => 'contents', 'action' => 'edit', $content->id]);?></small>
        <?php endif; ?>
    
    </h1>


    <p><?php echo ($content->description);?> </p>

<?php } else { ?>
    <h1>Important Info 
        
        <?php 
        if ($role == 'manufacturer'): ?>
            <small style="float:right;font-size:12px;">
            <?php echo $this->Html->link('Edit', ['controller' => 'contents', 'action' => 'add']);?></small>
        <?php endif; ?>
    
    </h1>


    <p>Please refer to your Manufacturer for specific Terms of Trade
    <!--<p>1. VERY IMPORTANT - The measurements supplied to the Manufacturer must be the <b>build sizes</b>. Please do not supply
        frame
        or
        opening sizes.</p>-->
    <!-- <p>2. An $8 bottle of PowaWash will be included with every Order dispatched by the Manufacturer. It is a condition
        of
        the
        10 Warranty that the Security Screens are maintained according to the ScreenGuard Maintenance Chart.</p> -->
   <!-- <p>2. 16mm Fringe Pile is included in the cost and will be supplied with Bug Strip.</p>
    <p>3. Both Horizontals and Verticals must be equal. No Trapezoids/Trapeziums</p>
    <p>4. Additional Sections will be supplied at the same colour of the Security Screens unless otherwise
        requested.</p>
    <p>5. When including Double Hinged Doors to an Order, the “T-Mullion” must be selected from the Additional Sections
        and
        a
        “Flush Bolt Dble Sec Door” from the Accessories for each set of doors added.</p>
    <p>6. All Screens are collect unless otherwise agreed.</p>-->
    </p>
<?php } ?>
</div>