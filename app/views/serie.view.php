<?php

class SerieView
{

    public function showSeries($series)
    {
        require 'templates/serie.list.phtml';
    }

    public function showSerie($serie, $piezas)
    {
        require 'templates/serie.detail.phtml';
    }
}
