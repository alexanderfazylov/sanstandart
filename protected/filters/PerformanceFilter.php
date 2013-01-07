<?php
class PerformanceFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        if(Yii::app()->user->isGuest){
           $cn = new Controller('1');
           $cn->redirect('/site/login');
        }
        return true;
    }
 
}