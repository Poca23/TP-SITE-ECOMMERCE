<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private const UPLOAD_DIR = __DIR__ . '/../assets/uploads/';
    private const UPLOAD_URL = 'assets/uploads/';
    private const MAX_SIZE = 2 * 1024 * 1024; // 2 Mo
    private const ALLOWED_MIME = ['image/png', 'image/jpeg', 'image/webp'];

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
        $this->verifyCsrf();
        [$name, $desc, $price, $img, $error] = $this->fields();
        if ($name === '' || $error !== '') {
            $error = $error ?: 'Le nom est requis.';
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
        $this->verifyCsrf();
        $product = $this->getProduct();
        [$name, $desc, $price, $img, $error] = $this->fields();
        if ($name === '' || $error !== '') {
            $error = $error ?: 'Le nom est requis.';
            $formTitle = 'Modifier le produit';
            require __DIR__ . '/../templates/products/form.php';
            return;
        }
        // Garde l'ancienne image si aucune nouvelle
        if ($img === '')
            $img = $product['img'];
        Product::update((int) $product['id'], $name, $desc, (float) $price, $img);
        header('Location: index.php?action=products');
        exit;
    }

    public function delete(): void
    {
        $this->requireAdmin();
        $this->verifyCsrf();
        $p = Product::findById((int) ($_POST['id'] ?? 0));
        if ($p && $p['img'] && file_exists(__DIR__ . '/../' . $p['img'])) {
            unlink(__DIR__ . '/../' . $p['img']);
        }
        Product::delete((int) ($_POST['id'] ?? 0));
        header('Location: index.php?action=products');
        exit;
    }

    // ── Helpers ────────────────────────────────────────────────────

    private function fields(): array
    {
        $name = trim(strip_tags($_POST['name'] ?? ''));
        $desc = trim(strip_tags($_POST['desc'] ?? ''));
        $price = $_POST['price'] ?? '0';
        $img = trim(strip_tags($_POST['img'] ?? ''));
        $error = '';

        // Upload prioritaire sur l'URL
        if (!empty($_FILES['img_file']['tmp_name'])) {
            $result = $this->handleUpload($_FILES['img_file']);
            if ($result['error']) {
                $error = $result['error'];
            } else {
                $img = $result['path'];
            }
        }

        return [$name, $desc, $price, $img, $error];
    }

    private function handleUpload(array $file): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Erreur lors de l\'upload.', 'path' => ''];
        }
        if ($file['size'] > self::MAX_SIZE) {
            return ['error' => 'Image trop lourde (max 2 Mo).', 'path' => ''];
        }

        // Vérification MIME réelle (pas le Content-Type client)
        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, self::ALLOWED_MIME, true)) {
            return ['error' => 'Format non autorisé (PNG, JPG, WEBP uniquement).', 'path' => ''];
        }

        $ext = ['image/png' => 'png', 'image/jpeg' => 'jpg', 'image/webp' => 'webp'][$mime];
        $filename = bin2hex(random_bytes(12)) . '.' . $ext;
        $dest = self::UPLOAD_DIR . $filename;

        if (!is_dir(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            return ['error' => 'Impossible de sauvegarder l\'image.', 'path' => ''];
        }

        return ['error' => '', 'path' => self::UPLOAD_URL . $filename];
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
