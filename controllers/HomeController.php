<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/Product.php';

class HomeController
{
    public function index(): void
    {
        $featured = Product::paginate(1, 4)['items'];
        require __DIR__ . '/../templates/home/index.php';
    }
}
