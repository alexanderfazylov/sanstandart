<h6><?php echo $address->type.' '.$address->name; ?></h6>
<ul>
    <li class="<?php echo DayType::model()->findByPk($day_week->monday)->column; ?>">Пн</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->tuesday)->column; ?>">Вт</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->wednesday)->column; ?>">Ср</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->thursday)->column; ?>">Чт</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->friday)->column; ?>">Пт</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->saturday)->column; ?>">Сб</li>
    <li class="<?php echo DayType::model()->findByPk($day_week->sunday)->column; ?>">Вс</li>
</ul>
<p class="pn"><?php echo $working_time->full_time; ?></p>
<p class="sb"><?php echo $working_time->part_time; ?></p>
<p class="vs">Выходной</p>
