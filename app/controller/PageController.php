<?php

namespace App\Controller;

use App\Core\Helper;


class PageController
{
    /**
     * Go to the homepage
     * @return mixed
     */
    public function home()
    {
        return Helper::view('index');
    }
}
