<?php

class PiezaView
{
    public function showPiezas($piezas, $series, $page, $pages)
    {
        $count = count($piezas);
        require 'templates/pieza.list.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
    public function showPieza($pieza)
    {
        require 'templates/pieza.detail.phtml';
    }
}
