<?php
Yii::app()->clientScript->registerScriptFile('/js/jquery.js');
Yii::app()->clientScript->registerScriptFile('/js/project.js');
$this->pageTitle=Yii::app()->name . ' - '.$collection->name;
$this->breadcrumbs=array(
	'Каталог продукции' => '/catalog',
        $collection->brand->name => '/catalog/viewBrand/'.$collection->brand->id
);
?>
<div id="content" class="view_collection">
        <h1><?php echo $collection->name; ?></h1>
        <?php echo $collection->text;?>
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