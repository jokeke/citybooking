<div class="timetable-block">
            <div class="row-fluid control-group">
                <div class="span3">
                    <?php echo CHtml::textField('timetableId[]', '',  array('style'=>'width: 90%; display:none;', 'class'=>'id'))?>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('from'.$i, '',array('class'=>'span6 hasDatepicker', 'placeholder' => 'От',)) ?>
                    </div>
                </div>
                <div class="span3">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php echo CHtml::textField('to'.$i, '',array('class'=>'span6 hasDatepicker', 'placeholder' => 'До',)) ?>
                    </div>
                </div>
                <button class="close">&times;</button>
            </div>
            <div class="row-fluid control-group">
                <div class="span3">
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>array(
                            '1'=>'Пн',
                            '2'=>'Вт',
                            '3'=>'Ср',
                            '4'=>'Чт',
                            '5'=>'Пт',
                            '6'=>'Сб',
                            '0'=>'Вс',
                        ),
                        'value'=>$t->week,
                        'asDropDownList' => true,
                        'name' => 'week'.$i,
                        //'separator'=>'/',
                        'htmlOptions'=>array(
                            'multiple'=>'multiple',

                        ),
                        'options' => array(
                            'placeholder' => 'Выберите дни недели',
                            'width' => '60%',
                        ))); ?>
                </div>

                <div class="span3">
                    <? $this->widget('bootstrap.widgets.TbSelect2', array(
                        'data'=>TourTimetable::model()->getHtmlListTime(),
                        'value'=> $t->time,
                        'asDropDownList' => true,
                        'name' => 'time'.$i,
                        //'separator'=>'/',
                        'htmlOptions'=>array(
                            'multiple'=>'multiple',
                        ),
                        'options' => array(
                            'placeholder' => 'Выберите время',
                            'width' => '60%',
                        ))); ?>
                </div>
            </div>
            </br>
        </div>