<?php


namespace sgbdtrue\views;


interface IView
{
    /**
     * @param array $data
     * @return void
     */
    public function showView(array $data);
}