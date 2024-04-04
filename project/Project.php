<?php
 
class Project extends CWebModule
{
    public function init()
    {
        $this->setImport(
            array(
                'project.models.*',
                'project.components.*',
            )
        );
        parent::init();
    }
}
 
 
