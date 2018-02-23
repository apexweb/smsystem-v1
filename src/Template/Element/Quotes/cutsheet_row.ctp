<tr id="cutsheet-row-<?= $i ?>" class="cutsheets-rows">
    <?= $this->Form->hidden('cutsheets.' . $i . '.id'); ?>
    <td>
        <?= $this->Form->input('cutsheets.' . $i . '.qty', ['label' => false, 'class' => 'form-control input-sm']); ?>
    </td>

    <td>
        <div class="input select" style="height:30px;padding-top:2px;">
            <?php    
                $select_style = '';
                $input_style = 'display:none;';
                $select_name = 'section'; 
                $input_name = 'sect_ion';

                if(isset($quote->cutsheets[$i]->section)){
                    if(!isset($additional_per_meter[$quote->cutsheets[$i]->section]) ){
                        $select_style = '';
                        $input_style = '';
                        $select_name = 'sect_ion'; 
                        $input_name = 'section';
                    }
                }
            ?>       
            <?= $this->Form->input(
                'cutsheets.' . $i . '.'.$select_name,
                [
                    'type' => 'select',
                    'options' => array_merge($additional_per_meter, array('Other'=>'Other')),
                    'empty' => true,
                    'label' => false,
                    'class' => 'form-control input-sm cutsheets-additional-section additional-select-name',
                    'templates' => [
                        'inputContainer' => '{{content}}'],
                    'style' => $select_style
                    ]                    
            ); ?>
            <?= $this->Form->input('cutsheets.' . $i . '.'.$input_name,  [
                    'label' => false, 
                    'class' => 'form-control input-sm additional-input-name editOption', 
                    'style' => $input_style, 
                    'templates' => [
                        'inputContainer' => '{{content}}']
                    ]                    
                );
            ?>
        </div>
    </td>

    <td>
        <div class="input select" style="height:30px;padding-top:2px;">
            <?php    
                $select_style = '';
                $input_style = 'width:81%;display:none;';
                $select_name = 'colour'; 
                $input_name = 'col_our';
                //echo $quote->cutsheets[$i]->colour;
                if(isset($quote->cutsheets[$i]->colour)){
                    if(!isset($colours[$quote->cutsheets[$i]->colour]) ){
                        $select_style = '';
                        $input_style = 'width:81%;';
                        $select_name = 'col_our'; 
                        $input_name = 'colour';
                    }
                }
            ?>       
            <?= $this->Form->input(
                'cutsheets.' . $i . '.'.$select_name,
                [
                    'type' => 'select',
                    'options' => array_merge($colours, array('Other'=>'Other')),
                    'empty' => true,
                    'label' => false,
                    'class' => 'form-control input-sm cutsheets-additional-colour additional-select-colour',
                    'templates' => [
                        'inputContainer' => '{{content}}'],
                    'style' => $select_style
                    ]                    
            ); ?>
            <?= $this->Form->input('cutsheets.' . $i . '.'.$input_name,  [
                    'label' => false, 
                    'class' => 'form-control input-sm editOption additional-input-colour', 
                    'style' => $input_style, 
                    'templates' => [
                        'inputContainer' => '{{content}}']
                    ]                    
                );
            ?>
        </div>
        <?php //$this->Form->input('cutsheets.' . $i . '.colour', ['label' => false, 'class' => 'form-control input-sm']); ?>
    </td>

    <td>
        <?= $this->Form->input('cutsheets.' . $i . '.cut_to_size', ['label' => false, 'class' => 'form-control input-sm']); ?>

    </td>
    <td>


        <?= $this->Form->input('cutsheets.' . $i . '.notes', ['label' => false, 'class' => 'form-control input-sm']); ?>

    </td>

    <td>
        <button type="button"
                class="delete-btn cutsheet-delete-btn"><i class="typcn typcn-delete"></i>
        </button>
    </td>

</tr>