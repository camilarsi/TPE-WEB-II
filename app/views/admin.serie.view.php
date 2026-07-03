<?php

class AdminSerieView
{

    public function showSeries($series)
    {
        require 'templates/admin/serie.list.phtml';
    }

    public function showFormAlta($error = null)
    {
        require 'templates/admin/serie.form.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
}
