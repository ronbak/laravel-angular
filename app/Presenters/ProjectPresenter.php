<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 18:29
 */

namespace LaravelAngular\Presenters;

use LaravelAngular\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends  FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }

}