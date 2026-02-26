<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {

    private int $perPage = 4;

    public function index(): void {
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $data = Product::paginate($page, $this->perPage);
        require __DIR__ . '/../templates/products/list.php';
    }

    public function create(): void {
        $this->requireAdmin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$name, $desc, $price, $img] = $this->formFields();
            if ($name === '') {
                $error = 'Le nom est requis.';
            } else {
                Product::create($name, $desc, (float)$price, $img);
                header('Location: index.php');
                exit;
            }
        }

        $product = null;
        $formTitle = 'Ajouter un produit';
        require __DIR__ . '/../templates/products/form.php';
    }

    public function edit(): void {
        $this->requireAdmin();
        $id      = (int)($_GET['id'] ?? 0);
        $product = Product::findById($id);
        $error   = '';

        if (!$product) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            [$name, $desc, $price, $img] = $this->formFields();
            if ($name === '') {
                $error = 'Le nom est requis.';
            } else {
                Product::update($id, $name, $desc, (float)$price, $img);
                header('Location: index.php');
                exit;
            }
        }

        $formTitle = 'Modifier le produit';
        require __DIR__ . '/../templates/products/form.php';
    }

    public function delete(): void {
        $this->requireAdmin();
        $id      = (int)($_GET['id'] ?? 0);
        $product = Product::findById($id);

        if (!$product) {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrf();
            Product::delete($id);
            header('Location: index.php');
            exit;
        }

        require __DIR__ . '/../templates/products/confirm-delete.php';
    }

    /* ── helpers ── */

    private function requireAdmin(): void {
        if (($_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php');
            exit;
        }
    }

    private function formFields(): array {
        $this->verifyCsrf();
        return [
            trim(strip_tags($_POST['name']  ?? '')),
            trim(strip_tags($_POST['desc']  ?? '')),
            $_POST['price'] ?? '0',
            trim(strip_tags($_POST['img']   ?? '')),
        ];
    }

    private function verifyCsrf(): void {
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
            http_response_code(403);
            exit('Token CSRF invalide.');
        }
    }
}
