<?php

class AdminPiezaView
{

    public function showPiezas($piezas)
    {
        require 'templates/admin/pieza.list.phtml';
    }

    public function showFormAlta($series, $error = null)
    {
        require 'templates/admin/pieza.form.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }

    public function showFormEditar($pieza, $series, $error = null)
    {
        require 'templates/admin/pieza.edit.phtml';
    }
}
