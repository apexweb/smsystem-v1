
<div class="form-group">

    <div class="col-sm-2">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('standard', ['type' => 'checkbox', 'class' => 'coating',  'templates' => [
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>

        </div>
    </div>

    <div class="col-sm-3">
        <?= $this->Form->select(
            'standard_color',
            $standards,
            ['empty' => ' ', 'label' => false, 'class' => 'form-control input-sm', 'data-style' => 'btn-primary']
        );
        ?>
    </div>

    <div class="col-sm-4">
        <?= $this->Form->input('second_color_required', ['type' => 'checkbox', 'label' => 'Is Second color required?',
            'templates' => ['nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']])
        ?>

    </div>

    <div class="col-sm-3">

        <?= $this->Form->input('window_door_suite_manufacturer',
            ['class' => 'form-control', 'label' => false,
                "placeholder" => "Window, Door Suite Manufacturer",]) ?>


    </div>

</div>


<hr>

<div class="form-group">

    <div class="col-sm-2">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('color1', ['type' => 'checkbox', 'class' => 'color_s coating', 'label' => 'Custom Colour', 'templates' => [
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>

        </div>
    </div>

    <div class="col-sm-3">

        <?= $this->Form->select(
            'color1_color',
            $color1,
            ['empty' => ' ', 'label' => false, 'class' => 'form-control color_s input-sm', 'data-style' => 'btn-primary']
        );
        ?>
    </div>
</div>

<div class="form-group">


    <div class="col-sm-2">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('color2', ['type' => 'checkbox', 'class' => 'color_s coating', 'label' => 'Premium Colour', 'templates' => [
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>

        </div>
    </div>

    <div class="col-sm-3">

        <?= $this->Form->select(
            'color2_color',
            $color2,
            ['empty' => ' ', 'label' => false, 'class' => 'form-control color_s input-sm', 'data-style' => 'btn-primary']
        );
        ?>
    </div>

</div>

<div class="form-group">


    <div class="col-sm-2">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('color3', ['type' => 'checkbox', 'class' => 'color_s coating', 'label' => 'Anodized', 'templates' => [
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>

        </div>
    </div>

    <div class="col-sm-3">

        <?= $this->Form->select(
            'color3_color',
            $color3,
            ['empty' => ' ', 'label' => false, 'class' => 'form-control color_s input-sm', 'data-style' => 'btn-primary']
        );
        ?>
    </div>

</div>


<div class="form-group">


    <div class="col-sm-2">
        <div class="checkbox checkbox-primary">

            <?= $this->Form->input('color4', ['type' => 'checkbox', 'class' => 'color_s coating', 'label' => 'Special Colour', 'templates' => [
                'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>']]) ?>

        </div>
    </div>

    <div class="col-sm-3">

        <?= $this->Form->select(
            'color4_color',
            $color4,
            ['empty' => ' ', 'label' => false, 'class' => 'form-control color_s input-sm', 'data-style' => 'btn-primary']
        );
        ?>
    </div>

</div>