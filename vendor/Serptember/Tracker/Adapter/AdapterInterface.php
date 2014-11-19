<?php

namespace Serptember\Tracker\Adapter;


interface AdapterInterface
{
    /**
     * @return mixed
     */
    public function getOptions();

    /**
     * @return mixed
     */
    public function formatSearchUrl();

    /**
     * @return mixed
     */
    public function find();
} 