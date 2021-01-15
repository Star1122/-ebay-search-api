<?php

namespace App\Repositories\Product;

use App\Repositories\EloquentRepositoryInterface;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Get Team detail data
     *
     * @param $data
     * @return mixed
     */
    public function searchProduct($data);

}
