<?php

class PiezaView
{
    public function showPiezas($piezas, $series)
    {
        $count = count($piezas);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
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
