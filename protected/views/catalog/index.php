<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
	'',
);
?>
<div id="content" class="catalog">
        <h1>Каталог</h1>
        <?php foreach($collections as $collection){
            echo '<div class="cat">'.CHtml::link( CHtml::image('/uploads/'.$collection->preview), '/catalog/viewCollection/'.$collection->id).'<br/>'.$collection->name.'<br/>'.CHtml::link($collection->brand->name, array('/catalog/viewBrand', 'id'=>$collection->brand->id)) .'</div>';
        }?>
</div><!-- #content-->

<div class="sidebar" id="sideRight">
        <div class="bl">
                <ul class="menu_cat">
                <?php
                        foreach($section as $sect){
                            echo '<li>';
                            echo '<h6>'.$sect->name.'</h6>';
                            echo '<ul>';
                            foreach($sect->brand as $brand)
                                echo '<li>'.CHtml::link($brand->name, array('/catalog/viewBrand', 'id'=>$brand->id)).'</li>';
                             echo '</ul>';
                             echo '</li>';
                        }
                    ?>        
                </ul>
        </div>

</div><!-- .sidebar#sideRight -->