<?php 
namespace frontend\components;

use yii\base\Widget;

class ProjectStageWidget extends Widget
{
    
    public function run()
    {
        return $this->render('projectStage');
    }
}