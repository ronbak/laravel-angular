<?php
/**
 * Created by PhpStorm.
 * User: RaylanLocal
 * Date: 06/04/2016
 * Time: 21:50
 */

namespace LaravelAngular\Repositories;


use LaravelAngular\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return Client::class;
    }
}