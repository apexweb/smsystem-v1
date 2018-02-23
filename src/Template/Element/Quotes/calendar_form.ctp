<div class="row" style="margin-bottom: 15px;">
    <div class="col-md-9">

    </div>


    <div class="col-md-3 search-form">
        <?= $this->Form->create($this, ['type' => 'get', 'class' => 'form-inline search-form']) ?>
            <?php $formattedMonthArray = array(
                    "1" => "January", "2" => "February", "3" => "March", "4" => "April",
                    "5" => "May", "6" => "June", "7" => "July", "8" => "August",
                    "9" => "September", "10" => "October", "11" => "November", "12" => "December",
                ); ?>
            <?php
            $currentYear = date('Y');
            $formattedYearArray = [];
            foreach (range(2016, $currentYear) as $value) {
                $formattedYearArray[$value] = $value;
            } ?>
            <?= $this->Form->select(
                'month',
                $formattedMonthArray,
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true, 'value' => $month]
            );?>
           
            <?= $this->Form->select(
                'year',
                $formattedYearArray,
                ['class' => 'form-control status-dropdown input-sm', 'data-style' => 'btn-primary', 'label' => true, 'value' => $year]
            );?>
            <div class="input-group">
                <span class="input-group-btn">
                    <?= $this->Form->Button('Go', ['class' => 'btn waves-effect waves-light btn-primary btn-sm']) ?>
                </span>
            </div>
       
        <?= $this->Form->end() ?>

    </div> <!-- .search-form -->
</div>