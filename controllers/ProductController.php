<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $data = Product::paginate($page, 8);
        require __DIR__ . '/../templates/products/list.php';
    }

    public function createForm(): void
    {
        $this->requireAdmin();
        $error = '';
        $product = null;
        $formTitle = 'Ajouter une licorne';
        require __DIR__ . '/../templates/products/form.php';
    }

    public function create(): void
    {
        $this->requireAdmin();
        [$name, $desc, $price, $img] = $this->fields();
        $error = '';
        if ($name === '') {
            $error = 'Le nom est requis.';
            $product = null;
            $formTitle = 'Ajouter une licorne';
            require __DIR__ . '/../templates/products/form.php';
            return;
        }
        Product::create($name, $desc, (float) $price, $img);
        header('Location: index.php?action=products');
        exit;
    }

    public function editForm(): void
    {
        $this->requireAdmin();
        $product = $this->getProduct();
        $error = '';
        $formTitle = 'Modifier le produit';
        require __DIR__ . '/../templates/products/form.php';
    }

    public function edit(): void
    {
        $this->requireAdmin();
        $product = $this->getProduct();
        [$name, $desc, $price, $img] = $this->fields();
        $error = '';
        if ($name === '') {
            $error = 'Le nom est requis.';
            $formTitle = 'Modifier le produit';
            require __DIR__ . '/../templates/products/form.php';
            return;
        }
        Product::update((int) $product['id'], $name, $desc, (float) $price, $img);
        header('Location: index.php?action=products');
        exit;
    }

    public function delete(): void
    {
        $this->requireAdmin();
        $this->verifyCsrf();
        Product::delete((int) ($_POST['id'] ?? 0));
        header('Location: index.php?action=products');
        exit;
    }

    private function getProduct(): array
    {
        $p = Product::findById((int) ($_GET['id'] ?? 0));
        if (!$p) {
            header('Location: index.php?action=products');
            exit;
        }
        return $p;
    }

    private function fields(): array
    {
        $this->verifyCsrf();
        return [
            trim(strip_tags($_POST['name'] ?? '')),
            trim(strip_tags($_POST['desc'] ?? '')),
            $_POST['price'] ?? '0',
            trim(strip_tags($_POST['img'] ?? '')),
        ];
    }

    private function requireAdmin(): void
    {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php');
            exit;
        }
    }

    private function verifyCsrf(): void
    {
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('CSRF invalide.');
        }
    }
}
