<?php

namespace Admin\Controller;

class SettingController extends AdminController
{
    public function general()
    {
        $this->load->model('setting');

        $this->data['settings'] = $this->model->setting->getSettings();

        $this->view->render('setting/general', $this->data);
    }


}