<?php
/**
 * Created by PhpStorm.
 * User: Parham-Pc
 * Date: 2/20/2017
 * Time: 2:24 AM
 */

namespace App;

use Cake\ORM\TableRegistry;


class Calculator_mx
{

    private $quote;

    private $ssMarkedup = 0;
    private $dgMarkedup = 0;
    private $fibrMarkedup = 0;
    private $perfMarkedup = 0;


    private $discountedAmount = 0;

    private $installation = 0;
    private $totalInstallation = 0;
    private $totalSellPrice = 0;
    private $profit = 0;


    private $mc_parts = [];
    private $additionals_m = [];
    private $additionals_l = [];
    private $accessories = [];


//**** Hourly Rates ****//
    private $sdHrlyRate;// = 30.00;
    private $swHrlyRate;// = 30.00;
    private $ddHrlyRate;// = 30.00;
    private $dwHrlyRate;// = 30.00;
    private $fdHrlyRate;// = 30.00;
    private $fwHrlyRate;// = 30.00;
    private $pdHrlyRate;// = 30.00;
    private $pwHrlyRate;// = 30.00;

    //----------
    private $incMidrail;


    /*** Clean Ups ***/
    private $secWindowCleanUp;// = 30.00;
    private $secDoorCleanUp;//= 90.00;

    private $dgWindowCleanup;// = 25;
    private $dgDoorCleanup;// = 90;

    private $fibrWindowCleanup;// = 5;
    private $fibrDoorCleanup;// = 25;

    private $perfDoorCleanup;// = 80;
    private $perfWindowCleanup;// = 25;


    /*** Product Markups ***/
    private $sdMarkup;
    private $swMarkup;
    private $ddMarkup;
    private $dwMarkup;
    private $fdMarkup;
    private $fwMarkup;
    private $pdMarkup;
    private $pwMarkup;


    //Lock Typees
    private $singleLock;
    private $tripleLock;


//**** Parts ****//


    /** Master Markups **/
    private $masterMarkup = [];

    private $auth;

    private $stocks;
    private $stockMetas = [];
    private $matrixTables;
    private $userInstallations;

    private $custom_color_door;
    private $custom_color_win;
    private $pr_color_door;
    private $pr_color_win;    
    private $anodized_color_door;
    private $anodized_color_win;
    private $special_color_door;
    private $special_color_win;


    private $dgInsDoorPetMarkup;// = 0;
    private $dgInsWinPetMarkup;// = 0;


// **********


    function __construct($quote, $auth, $stocks)
    {
        $this->quote = $quote;
        $this->auth = $auth;
        $this->stocks = $stocks;
        $this->setValues();

    }


    public function calculatePrices()
    {
        foreach ($this->quote['products'] as $product) {
            $this->calculateProduct($product);
        }
//        foreach ($this->quote['midrails'] as $midrail) {
//            $this->calculateMidrail($midrail);
//        }
//
        foreach ($this->quote['additionalpermeters'] as $additionalpermeter) {
            $this->calculateAdditionalM($additionalpermeter);
        }

        foreach ($this->quote['additionalperlength'] as $additionalLength) {
            $this->calculateAdditionalL($additionalLength);
        }

        foreach ($this->quote['accessories'] as $accessory) {
            $this->calculateAccessory($accessory);
        }

        foreach ($this->quote['customitems'] as $customitem) {
            $this->calculateCustomItem($customitem);
        }

        if ($this->quote['installation_type'] == 'preset amount') {
            $this->totalInstallation = round($this->installation + $this->quote['freight_cost'], 2);
            $this->quote['installation_preset_amount'] = $this->installation;
            $this->quote['installation_custom_amount'] = 0;
        } else if ($this->quote['installation_type'] == 'custom amount') {
            $this->totalInstallation = round($this->quote['installation_custom_amount'] + $this->quote['freight_cost']);
            $this->quote['installation_preset_amount'] = 0;
        }
        else if ($this->quote['installation_type'] == 'incorporate install') {
            $this->totalInstallation = round($this->installation + $this->quote['freight_cost'], 2);
            $this->quote['installation_preset_amount'] = 0;
            $this->quote['installation_custom_amount'] = 0;
        }
       

        $this->quote['discount_amount'] = $this->discountedAmount;
        $this->quote['installation_total_cost'] = $this->totalInstallation;
        
        $this->quote['total_sell_price'] = round($this->totalSellPrice + $this->totalInstallation - $this->discountedAmount, 2);
        $this->quote['profit'] = round($this->profit - $this->discountedAmount, 2);

        $this->quote['ss_markup_amount'] = $this->ssMarkedup;
        $this->quote['dg_markup_amount'] = $this->dgMarkedup;
        $this->quote['fibr_markup_amount'] = $this->fibrMarkedup;
        $this->quote['perf_markup_amount'] = $this->perfMarkedup;
       
        return $this->stockMetas;
    }


    private function calculateProduct($product)
    {
        $qty = 1;
        $newQty = $product->product_qty;
        $secDigFibr = $product->product_sec_dig_perf_fibr;
        $winDoor = $product->product_window_or_door;
        $infill = $product->product_316_ss_gal_pet;
        $height = $product->product_height;
        $width = $product->product_width;
        $lockCount = $product->product_lock_qty;
        $lockType = $product->product_lock_type;
        $incMidrail = $product->product_inc_midrail;
        
        $productColour = $product->product_colour;
        


        $matrixArr = null;
        $hrlyRate = 0;
        $cleanUp = 0;
        $markup = 0;
        $tableName = '';

        if ($secDigFibr == '316 S/S' && $winDoor == 'Door') {
            $matrixArr = $this->matrixTables['S/S Hinged and Sliding Doors']['prices'];
            $tableName = 'S/S Hinged and Sliding Doors';
            $hrlyRate = $this->sdHrlyRate;
            $cleanUp = $this->secDoorCleanUp;
            $markup = $this->sdMarkup;

        } else if ($secDigFibr == '316 S/S' && $winDoor == 'Window') {
            $matrixArr = $this->matrixTables['S/S Window Screens']['prices'];
            $tableName = 'S/S Window Screens';
            $hrlyRate = $this->swHrlyRate;
            $cleanUp = $this->secWindowCleanUp;
            $markup = $this->swMarkup;

        } else if ($secDigFibr == 'D/Grille' && $winDoor == 'Door') {
            $matrixArr = $this->matrixTables['DG Hinged and Sliding Doors']['prices'];
            $tableName = 'DG Hinged and Sliding Doors';
            $hrlyRate = $this->ddHrlyRate;
            $cleanUp = $this->dgDoorCleanup;
            $markup = $this->ddMarkup;

        } else if ($secDigFibr == 'D/Grille' && $winDoor == 'Window') {
            $matrixArr = $this->matrixTables['DG Windows']['prices'];
            $tableName = 'DG Windows';
            $hrlyRate = $this->dwHrlyRate;
            $cleanUp = $this->dgWindowCleanup;
            $markup = $this->dwMarkup;

        } else if ($secDigFibr == 'Insect' && $winDoor == 'Door') {
            $matrixArr = $this->matrixTables['Insect Hinged and Sliding Doors']['prices'];
            $tableName = 'Insect Hinged and Sliding Doors';
            $hrlyRate = $this->fdHrlyRate;
            $cleanUp = $this->fibrDoorCleanup;
            $markup = $this->fdMarkup;

        } else if ($secDigFibr == 'Insect' && $winDoor == 'Window') {
            $matrixArr = $this->matrixTables['Insect Screens']['prices'];
            $tableName = 'Insect Screens';
            $hrlyRate = $this->fwHrlyRate;
            $cleanUp = $this->fibrWindowCleanup;
            $markup = $this->fwMarkup;

        } else if ($secDigFibr == 'Perf' && $winDoor == 'Door') {
            $matrixArr = $this->matrixTables['Perf Hinged and Sliding Doors']['prices'];
            $tableName = 'Perf Hinged and Sliding Doors';
            $hrlyRate = $this->pdHrlyRate;
            $cleanUp = $this->perfDoorCleanup;
            $markup = $this->pdMarkup;

        } else if ($secDigFibr == 'Perf' && $winDoor == 'Window') {
            $matrixArr = $this->matrixTables['Perf Windows']['prices'];
            $tableName = 'Perf Windows';
            $hrlyRate = $this->pwHrlyRate;
            $cleanUp = $this->perfWindowCleanup;
            $markup = $this->pwMarkup;
        }

        //die(debug($this->matrixTables));
        $price = 0;
        if ($matrixArr) {

            $filteredArray = array_filter($matrixArr, function ($item) use ($width, $height) {
                return $width <= $item->width && $height <= $item->height;
            });

            if (count($filteredArray) > 0) {
                $filteredArray = array_values($filteredArray);

                $price = $filteredArray[0]->price;
            }
        }


        $price = $price * $qty;

        $customColor = 0;
        $premiumColor = 0;
        $anodizedColor = 0;
        $specialColor = 0;

        if ($productColour) {
            list($colourGroup, $pColour) = explode('|', $productColour);
            
            if ($winDoor == 'Door') {
                if ($colourGroup == 'Custom Colour') {
                    $customColor = ($qty * $this->custom_color_door);
                }
                if ($colourGroup == 'Anodized') {
                    $anodizedColor = ($qty * $this->anodized_color_door);
                }
                if ($colourGroup == 'Premium Colour') {
                    $premiumColor = ($qty * $this->pr_color_door);
                }
                if ($colourGroup == 'Special Colour') {
                    $specialColor = ($qty * $this->special_color_door);
                }                    
            } else if ($winDoor == 'Window') {
                if ($colourGroup == 'Custom Colour') {
                    $customColor = ($qty * $this->custom_color_win);
                }
                if ($colourGroup == 'Anodized') {
                    $anodizedColor = ($qty * $this->anodized_color_win);
                }
                if ($colourGroup == 'Premium Colour') {
                    $premiumColor = ($qty * $this->pr_color_win);
                }
                if ($colourGroup == 'Special Colour') {
                    $specialColor = ($qty * $this->special_color_win);
                } 
            }               
        
        } else {
            //*** Calculates Powder Coats ****
            if ($winDoor == 'Door') {
                
                if (!empty($this->quote['color1_color']) && $this->quote['color1']) {
                    $customColor = ($qty * $this->custom_color_door);
                }
                if (!empty($this->quote['color2_color']) && $this->quote['color2']) {
                    $premiumColor = ($qty * $this->pr_color_door);
                }
                if (!empty($this->quote['color3_color']) && $this->quote['color3']) {
                    $anodizedColor = ($qty * $this->anodized_color_door);
                }
                if (!empty($this->quote['color4_color']) && $this->quote['color4']) {
                    $specialColor = ($qty * $this->special_color_door);
                }
            } else if ($winDoor == 'Window') { 
                
                if (!empty($this->quote['color1_color']) && $this->quote['color1']) {
                    $customColor = ($qty * $this->custom_color_win);
                }
                if (!empty($this->quote['color2_color']) && $this->quote['color2']) {
                    $premiumColor = ($qty * $this->pr_color_win);
                }
                if (!empty($this->quote['color3_color']) && $this->quote['color3']) {
                    $anodizedColor = ($qty * $this->anodized_color_win);
                }
                if (!empty($this->quote['color4_color']) && $this->quote['color4']) {
                    $specialColor = ($qty * $this->special_color_win);
                }
            }
        }
       

        $petMeshMarkup = 0;
        if (($secDigFibr == 'Insect' || $secDigFibr == 'D/Grille') && $infill == 'Pet Mesh') {
            if ($winDoor == 'Door') {
                $petMeshMarkup = $this->dgInsDoorPetMarkup;
            } else if ($winDoor == 'Window') {
                $petMeshMarkup = $this->dgInsWinPetMarkup;
            }
        }


        $labourIncCutting = ($hrlyRate / 60) * $cleanUp;
        $priceWithHrlyRate = $price + $labourIncCutting;

        $priceWithHrlyRate = $priceWithHrlyRate * ($petMeshMarkup + 100) / 100;

        $price = $priceWithHrlyRate;
        $totalPrice = $price * ($markup + 100) / 100;



        $masterMarkup = $this->getMasterMarkupByMatrixTable($tableName);
        $totalPrice = $totalPrice * ($masterMarkup + 100) / 100;

        $totalPrice = $totalPrice + $customColor + $premiumColor + $anodizedColor + $specialColor;


//        $this->fillStocks($frame, 'frame');
//        $this->fillStocks($cnrStake, 'component');




        $this->calculateInstallation($newQty, $secDigFibr, $winDoor);


        //If Include Midrail Checkbox is Ticked
        if ($incMidrail && is_numeric($this->incMidrail)) {
            $totalPrice = $totalPrice + $this->incMidrail;
        }
        /*if ($this->quote['installation_type'] == 'incorporate install') {
            $product->product_incorporate_install;
            $totalPrice = $totalPrice + $product->product_incorporate_install;
        }*/
        $totalPrice ;
        $totalPrice *= $newQty;
        
        /*** Increase cost when LOCK Type is Changed ***/
        if ($winDoor == 'Door') {
            if ($secDigFibr == 'Insect') {
                $totalPrice = $totalPrice - ($this->singleLock * $newQty);
            } else {
                $totalPrice = $totalPrice - ($this->tripleLock * $newQty);
            }

            if ($lockType == 'Single' && $lockCount > 0) {
                //Single LOCK
                $totalPrice = $totalPrice + ($lockCount * $this->singleLock);
                //        die('is Single');
            } else if ($lockType == 'Triple' && $lockCount > 0) {
                //Triple LOCK
                $totalPrice = $totalPrice + ($lockCount * $this->tripleLock);
            }
        }

        $sellPrice = $totalPrice;
        if ($this->getRole() != 'retailer') {
            if ($secDigFibr) {
                $markup = $this->getMarkupBySecDgFibr($secDigFibr);
                $sellPrice = $totalPrice * ($markup + 100) / 100;
            }
        }

        $profit = round($sellPrice - $totalPrice, 2);
        $this->setMarkedupAmount($secDigFibr, $profit);

        $discount = $this->quote['discount'];
        if ($discount > 0) {

            $discounted = round($sellPrice * $discount / 100, 2);
            $this->discountedAmount += $discounted;
        }

        $this->profit += $profit;
        $this->totalSellPrice += round($sellPrice, 2);

        $product->product_cost = round($sellPrice, 2);
       
    }


    private function getMarkupBySecDgFibr($secDgFibr)
    {
        $markup = 0;
        switch ($secDgFibr) {
            case '316 S/S':
                $markup = $this->quote['ss_markup'];
                break;
            case 'D/Grille':
                $markup = $this->quote['dg_markup'];
                break;
            case 'Insect':
                $markup = $this->quote['fibr_markup'];
                break;
            case 'Perf':
                $markup = $this->quote['perf_markup'];
                break;
        }
        return $markup;
    }


    private function setMarkedupAmount($secDgFibr, $profit)
    {
        switch ($secDgFibr) {
            case '316 S/S':
                $this->ssMarkedup += $profit;
                break;
            case 'D/Grille':
                $this->dgMarkedup += $profit;
                break;
            case 'Insect':
                $this->fibrMarkedup += $profit;
                break;
            case 'Perf':
                $this->perfMarkedup += $profit;
                break;
        }
    }


    private function calculateMidrail($midrail)
    {
        $qty = $midrail->midrail_qty;
        $secDigFibr = $midrail->midrail_sec_dig_perf_fibr;
        $winDoor = $midrail->midrail_window_or_door;
        $type = $midrail->midrail_type;
        $height = $midrail->midrail_height;
        $width = $midrail->midrail_width;

        $matrixArr = null;
        if ($winDoor && $secDigFibr && $type) {
            $matrixArr = $this->matrixTables[$type]['prices'];
        }

//        $customColor = 0;
//        $premiumColor = 0;
//
//
//        //*** Calculates Powder Coats ****
//        if ($winDoor == 'Window') {
//            if (!empty($this->quote['color1_color']) && $this->quote['color1']) {
//                $customColor = ($qty * $this->custom_color_win);
//            }
//            if (!empty($this->quote['color2_color']) && $this->quote['color2']) {
//                $premiumColor = ($qty * $this->pr_color_win);
//            }
//        }

        //Calculate Price
        $price = 0;
        if ($matrixArr) {
            $filteredArray = array_filter($matrixArr, function ($item) use ($width, $height) {
                return $width <= $item->width && $height <= $item->height;
            });

            if (count($filteredArray) > 0) {
                $filteredArray = array_values($filteredArray);
                $price = $filteredArray[0]->price;
            }
        }

        $price = $price * $qty;
        $masterMarkup = $this->getMasterMarkupByMatrixTable($type);

        $markedUpCost = $price * ($masterMarkup + 100) / 100;

        //$totalCost = round($markedUpCost + $customColor + $premiumColor, 2);
//
//        $role = $this->getRole();
//        $masterMarkup = $this->getMasterMarkupByRole($role, $secDigFibr);
//        $priceInclGst = round(($resultTotal * ($masterMarkup + 100)) / 100, 2);
//
        $midrail->midrail_cost = $markedUpCost;
        $this->totalSellPrice += $markedUpCost;

    }


    private function calculateAdditionalM($additionalM)
    {
        $perMeter = $additionalM->additional_per_meter;
        $markup = $additionalM->additional_markup;

        $price = 0;
        if ($additionalM->additional_name) {
            $price = $this->additionals_m[$additionalM->additional_name];
        }
        /** Added the marked up logic for Additional meter to calculate sell price */
        $markedup = round($perMeter * $price * $markup / 100, 2);
        
        $total = round($price * $perMeter, 2);
        $totalCharged = round(($price * $perMeter) * ($markup + 100) / 100, 2);
        
        $additionalM->additional_price = $total;
        $this->profit += $markedup;
        $this->totalSellPrice += $totalCharged;
    }

    private function calculateAdditionalL($additionalL)
    {
        $perLength = $additionalL->additional_per_length;
        $markup = $additionalL->additional_markup;

        $price = 0;
        if ($additionalL->additional_name) {
            $price = $this->additionals_l[$additionalL->additional_name];
        }
        /** Added the marked up logic for Additional length to calculate sell price */
        $markedup = round($perLength * $price * $markup / 100, 2);

        $total = round($price * $perLength, 2);
        $totalCharged = round(($price * $perLength) * ($markup + 100) / 100, 2);
        
        $additionalL->additional_price = $total;
        $this->profit += $markedup;
        $this->totalSellPrice += $totalCharged;
    }

    private function calculateAccessory($accessory)
    {
        $each = $accessory->accessory_each;
        $markup = $accessory->accessory_markup;
        
        $price = 0;
        if ($accessory->accessory_name) {
            $price = $this->accessories[$accessory->accessory_name];
        }
        $markedup = round($each * $price * $markup / 100, 2);
        
        $total = round($price * $each, 2);
        $totalCharged = round(($price * $each) * ($markup + 100) / 100, 2);
        
        $accessory->accessory_price = $total;
        $this->profit += $markedup;
       // $this->totalSellPrice += $total;
        $this->totalSellPrice += $totalCharged;
    }

    private function calculateCustomItem($customItem)
    {
        $qty = $customItem->custom_qty;
        $price = $customItem->custom_price;
        $markup = $customItem->custom_markup;
        $ticked = $customItem->custom_tick;

        $markedup = round($qty * $price * $markup / 100, 2);

        $totalCharged = round(($qty * $price) * ($markup + 100) / 100, 2);
        $customItem->custom_charged = $totalCharged;

        $this->profit += $markedup;
        $this->totalSellPrice += $totalCharged;

        if ($ticked) {
            $totalCost = $totalCharged - $markedup;
            $discount = $this->quote['discount'];
            $discountedAmount = $totalCost * $discount / 100;
            $this->discountedAmount += $discountedAmount;
        }
    }


    private function calculateInstallation($qty, $secDgFibr, $winDoor)
    {
        $installation = 0;

        if ($qty > 0) {
            if ($secDgFibr == '316 S/S' || $secDgFibr == 'D/Grille' || $secDgFibr == 'Perf') {
                if ($winDoor == 'Door') {
                    if($this->quote['installation_type'] == 'incorporate install'){
                         $installation = $this->quote['installation_incorporate_amount'] * $qty;
                    }else{
                        if($this->userInstallations){
                            $installation = $this->userInstallations->door_amount * $qty;
                        }
                    }
                } else if ($winDoor == 'Window') {
                    if($this->quote['installation_type'] == 'incorporate install'){
                         $installation = $this->quote['installation_incorporate_amount'] * $qty;
                    }else{
                        if($this->userInstallations){
                            $installation = $this->userInstallations->window_amount * $qty;
                        }
                    }
                }
            } else if ($secDgFibr == 'Insect') {
                if ($winDoor == 'Door') {
                    if($this->quote['installation_type'] == 'incorporate install'){
                         $installation = $this->quote['installation_incorporate_amount'] * $qty;
                    }else{
                        if($this->userInstallations){
                            $installation = $this->userInstallations->insect_door_amount * $qty;
                        }
                    }
                } else if ($winDoor == 'Window') {
                    if($this->quote['installation_type'] == 'incorporate install'){
                         $installation = $this->quote['installation_incorporate_amount'] * $qty;
                    }else{
                        if($this->userInstallations){
                            $installation = $this->userInstallations->insect_window_amount * $qty;
                        }
                    }
                }
            }
        }
        if (is_numeric($installation)) {
            $this->installation += $installation;
        }
    }

    private function setValues()
    {
        $parts = TableRegistry::get('Parts');
        $mcvaluesTable = TableRegistry::get('Mcvalues');
        $installations = TableRegistry::get('Installations');
        $matrixTables = TableRegistry::get('Matrixtables');



        $matrixTables = $matrixTables->find('all',
            ['contain' => ['Prices' => function ($q) {
                $role = $this->auth->user('role');
                if ($role == 'manufacturer') {
                    $userId = $this->auth->user('id');
                } else {
                    $userId = $this->auth->user('parent_id');
                }
                return $q->where(['user_id' => $userId]);
            }]]
        );

        //*** Generate Matrix Tables Array Object ****//

        foreach ($matrixTables as $matrixTable) {
            $this->matrixTables[$matrixTable->name] = [
                'midrailReq' => json_decode($matrixTable->midrail_requirement),
                'prices' => (isset($matrixTable->prices[0]) ? json_decode($matrixTable->prices[0]->pricePerMesure) : false),
            ];
        }


        $this->userInstallations = $installations->find('all')->where(['user_id' => $this->auth->user('id')])->first();

        $parts = $parts->find('all')->contain(['users_parts' => function ($q) {
            $role = $this->auth->user('role');
            if ($role == 'manufacturer') {
                $userId = $this->auth->user('id');
            } else {
                $userId = $this->auth->user('parent_id');
            }
            return $q->where(['user_id' => $userId]);
        }]);

        $mcvalues = null;
        if ($this->auth->user('role') == 'manufacturer') {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->auth->user('id')])->first();
        } else {
            $mcvalues = $mcvaluesTable->find('all')->where(['user_id' => $this->auth->user('parent_id')])->first();
        }
        if (!$mcvalues) {
            $mcvalues = $mcvaluesTable->newEntity();
        }

        $this->masterMarkup = [
            //S/S
            'sd-dist' => $mcvalues->sd_dist,
            'sd-re' => $mcvalues->sd_re,
            'sd-whsl' => $mcvalues->sd_whsl,
            'sw-dist' => $mcvalues->sw_dist,
            'sw-re' => $mcvalues->sw_re,
            'sw-whsl' => $mcvalues->sw_whsl,
            //DG
            'dd-dist' => $mcvalues->dd_dist,
            'dd-re' => $mcvalues->dd_re,
            'dd-whsl' => $mcvalues->dd_whsl,
            'dw-dist' => $mcvalues->dw_dist,
            'dw-re' => $mcvalues->dw_re,
            'dw-whsl' => $mcvalues->dw_whsl,
            //Perf
            'pd-dist' => $mcvalues->pd_dist,
            'pd-re' => $mcvalues->pd_re,
            'pd-whsl' => $mcvalues->pd_whsl,
            'pw-dist' => $mcvalues->pw_dist,
            'pw-re' => $mcvalues->pw_re,
            'pw-whsl' => $mcvalues->pw_whsl,
            //Insect
            'id-dist' => $mcvalues->id_dist,
            'id-re' => $mcvalues->id_re,
            'id-whsl' => $mcvalues->id_whsl,
            'iw-dist' => $mcvalues->iw_dist,
            'iw-re' => $mcvalues->iw_re,
            'iw-whsl' => $mcvalues->iw_whsl,
            //Midrails
            'ioe-dist' => $mcvalues->ioe_dist,
            'ioe-re' => $mcvalues->ioe_re,
            'ioe-whsl' => $mcvalues->ioe_re,
            'ooe-dist' => $mcvalues->ooe_dist,
            'ooe-re' => $mcvalues->ooe_re,
            'ooe-whsl' => $mcvalues->ooe_whsl,
            //
            'dsw-dist' => $mcvalues->dsw_dist,
            'dsw-re' => $mcvalues->dsw_re,
            'dsw-whsl' => $mcvalues->dsw_whsl,



        ];



        /* HOURLY RATES */
        $this->sdHrlyRate = $mcvalues['hrly_sd'];
        $this->swHrlyRate = $mcvalues['hrly_sw'];
        $this->ddHrlyRate = $mcvalues['hrly_dd'];
        $this->dwHrlyRate = $mcvalues['hrly_dw'];
        $this->fdHrlyRate = $mcvalues['hrly_fd'];
        $this->fwHrlyRate = $mcvalues['hrly_fw'];
        $this->pdHrlyRate = $mcvalues['hrly_pd'];
        $this->pwHrlyRate = $mcvalues['hrly_pw'];

        /*** Clean Ups ***/
        $this->secWindowCleanUp = $mcvalues['cleanup_sw'];
        $this->secDoorCleanUp = $mcvalues['cleanup_sd'];

        $this->dgWindowCleanup = $mcvalues['cleanup_dw'];
        $this->dgDoorCleanup = $mcvalues['cleanup_dd'];

        $this->fibrWindowCleanup = $mcvalues['cleanup_fw'];
        $this->fibrDoorCleanup = $mcvalues['cleanup_fd'];

        $this->perfDoorCleanup = $mcvalues['cleanup_pd'];
        $this->perfWindowCleanup = $mcvalues['cleanup_pw'];

        $this->dgInsDoorPetMarkup = $mcvalues["dg_ins_door_infill"];
        $this->dgInsWinPetMarkup = $mcvalues["dg_ins_win_infill"];


        /*** Product Markups ***/
        $this->sdMarkup = $mcvalues['markup_sd'];
        $this->swMarkup = $mcvalues['markup_sw'];
        $this->ddMarkup = $mcvalues['markup_dd'];
        $this->dwMarkup = $mcvalues['markup_dw'];
        $this->fdMarkup = $mcvalues['markup_fd'];
        $this->fwMarkup = $mcvalues['markup_fw'];
        $this->pdMarkup = $mcvalues['markup_pd'];
        $this->pwMarkup = $mcvalues['markup_pw'];


        // **** Powder Coatings ****
        $this->custom_color_door = $mcvalues->custom_color_door;
        $this->custom_color_win = $mcvalues->custom_color_win;
        $this->pr_color_door = $mcvalues->pr_color_door;
        $this->pr_color_win = $mcvalues->pr_color_win;
        $this->anodized_color_door = $mcvalues->anodized_color_door;
        $this->anodized_color_win = $mcvalues->anodized_color_win;
        $this->special_color_door = $mcvalues->special_color_door;
        $this->special_color_win = $mcvalues->special_color_win;
         
        
        
        $this->incMidrail = $mcvalues->include_midrail_amount;

        $this->initializeParts($parts);


        //**** Parts ****//
        $this->singleLock = $mcvalues['single_lock'];
        $this->tripleLock = $mcvalues['triple_lock'];



        /** Master Markups **/
        $this->secPerf_dist = $mcvalues['secperf_dist'];
        $this->dgfibr_dist = $mcvalues['dgfibr_dist'];

        $this->secperf_whsl = $mcvalues['secperf_whsl'];
        $this->dgfibr_whsl = $mcvalues['dgfibr_whsl'];

        $this->secperf_re = $mcvalues['secperf_re'];
        $this->dgfibr_re = $mcvalues['dgfibr_re'];


    }


    private function initializeParts($parts)
    {
        foreach ($parts as $part) {
            $id = $part->id;
            $title = $part->title;
            $price = $part->users_parts[0]->price_per_unit;
            
            if ($part->users_parts[0]->show_in_additional_section_dropdown) {
                $this->additionals_m[$title] = $price;
            } else if ($part->show_in_additional_section_by_length_dropdown) {
                $this->additionals_l[$title] = $price;
            }
                                   
            if ($part->users_parts[0]->show_in_additional_section_by_length_dropdown) {
                $this->additionals_l[$title] = $price;
            } else if ($part->show_in_additional_section_by_length_dropdown) {
                $this->additionals_l[$title] = $price;
            }
            
            if ($part->users_parts[0]->show_in_accessories_dropdown) {
                $this->accessories[$title] = $price;
            } else if ($part->show_in_accessories_dropdown) {
                $this->accessories[$title] = $price;
            }
            
            if ($part->users_parts[0]->master_calculator_value) {
                $this->mc_parts[$id] = ['title' => $title, 'price' => $price];
            } else if ($part->master_calculator_value) {
                $this->mc_parts[$id] = ['title' => $title, 'price' => $price];
            }
            
            /*if ($part->show_in_additional_section_dropdown) {
                $this->additionals_m[$title] = $price;
            }
            if ($part->show_in_additional_section_by_length_dropdown) {
                $this->additionals_l[$title] = $price;
            }
            if ($part->show_in_accessories_dropdown) {
                $this->accessories[$title] = $price;
            }
            if ($part->master_calculator_value) {
                $this->mc_parts[$id] = ['title' => $title, 'price' => $price];
            }*/
        }
    }


    function getMasterMarkupByMatrixTable($tableName)
    {
        $masterMarkupKey = '';
        switch ($tableName) {
            case 'S/S Hinged and Sliding Doors':
                $masterMarkupKey = 'sd';
                break;
            case 'S/S Window Screens':
                $masterMarkupKey = 'sw';
                break;
            case 'Perf Hinged and Sliding Doors':
                $masterMarkupKey = 'pd';
                break;
            case 'Perf Windows':
                $masterMarkupKey = 'pw';
                break;
            case 'Double Sliding Window':
                $masterMarkupKey = 'dsw';
                break;
            case 'DG Hinged and Sliding Doors':
                $masterMarkupKey = 'dd';
                break;
            case 'Insect Hinged and Sliding Doors':
                $masterMarkupKey = 'id';
                break;
            case 'DG Windows':
                $masterMarkupKey = 'dw';
                break;
            case 'Insect Screens':
                $masterMarkupKey = 'iw';
                break;
            case 'Inward Opening Escapes [Side & Top Hung]':
                $masterMarkupKey = 'ioe';
                break;
            case 'Outward Opening Escapes [Side & Top Hung]':
                $masterMarkupKey = 'ooe';
                break;
        }

        if (isset($this->masterMarkup[$masterMarkupKey . '-' . $this->getShortRole()])) {
            return $this->masterMarkup[$masterMarkupKey . '-' . $this->getShortRole()];
        }
        return 0;
    }

    private function getRole()
    {
        $role = $this->quote['role'];
        $mfrole = $this->quote['mfrole'];

        if ($role == 'distributor' || $mfrole == 'distributor') {
            return 'distributor';
        } else if ($role == 'wholesaler' || $mfrole == 'wholesaler') {
            return 'wholesaler';
        } else if ($role == 'retailer' || $mfrole == 'retailer') {
            return 'retailer';
        }
        return null;
    }

    private function getShortRole()
    {
        $role = $this->getRole();
        if ($role == 'distributor') {
            return 'dist';
        }
        if ($role == 'wholesaler') {
            return 'whsl';
        }
        if ($role == 'retailer') {
            return 're';
        }
        return '';
    }


    private function getHourlyRate($secdgfibr, $winDoor)
    {
        $hourlyRate = 0;

        if ($secdgfibr && $winDoor) {
            if ($secdgfibr == '316 S/S' && $winDoor == 'Door') {
                $hourlyRate = $this->sdHrlyRate;
            } else if ($secdgfibr == '316 S/S' && $winDoor == 'Window') {
                $hourlyRate = $this->swHrlyRate;
            } else if ($secdgfibr == 'D/Grille' && $winDoor == 'Door') {
                $hourlyRate = $this->ddHrlyRate;
            } else if ($secdgfibr == 'D/Grille' && $winDoor == 'Window') {
                $hourlyRate = $this->dwHrlyRate;
            } else if ($secdgfibr == 'Insect' && $winDoor == 'Door') {
                $hourlyRate = $this->fdHrlyRate;
            } else if ($secdgfibr == 'Insect' && $winDoor == 'Window') {
                $hourlyRate = $this->fwHrlyRate;
            } else if ($secdgfibr == 'Perf' && $winDoor == 'Door') {
                $hourlyRate = $this->pdHrlyRate;
            } else if ($secdgfibr == 'Perf' && $winDoor == 'Window') {
                $hourlyRate = $this->pwHrlyRate;
            }
        }
        return $hourlyRate;

    }


    private function getTitleByValue($value)
    {
        $index = array_search($value, array_column($this->mc_parts, 'price'));

        $numeric_indexed_array = array_values($this->mc_parts);
        $title = ($numeric_indexed_array[$index]['title']);

        return $title;
    }


    private function fillStocks($value, $type)
    {
        $entity = $this->stocks->newEntity();
        $entity->metakey = $this->getTitleByValue($value);
        $entity->type = $type;
        $this->stockMetas[] = $entity;
    }

}
