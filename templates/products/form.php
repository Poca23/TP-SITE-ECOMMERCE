<?php ob_start(); ?>

<div class="form-wrapper">
    <h1 class="page-title"><?= htmlspecialchars($formTitle) ?></h1>

    <?php if (!empty($error)): ?>
        <p class="alert alert--error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="form">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <div class="form__group">
            <label>Nom</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($product['name'] ?? '') ?>">
        </div>

        <div class="form__group">
            <label>Description</label>
            <textarea name="desc" rows="3"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>

        <div class="form__group">
            <label>Prix (€)</label>
            <input type="number" name="price" step="0.01" min="0" required
                   value="<?= htmlspecialchars((string)($product['price'] ?? '')) ?>">
        </div>

        <div class="form__group">
            <label>URL Image <span class="form__hint">(optionnel si image uploadée)</span></label>
            <input type="text" name="img" id="img-url"
                   value="<?= htmlspecialchars($product['img'] ?? '') ?>"
                   placeholder="https://...">
        </div>

        <div class="form__group">
            <label>Importer une image <span class="form__hint">(PNG, JPG, WEBP — max 2 Mo)</span></label>
            <div class="upload-zone" id="upload-zone">
                <input type="file" name="img_file" id="img_file"
                       accept="image/png,image/jpeg,image/webp" class="upload-zone__input">
                <div class="upload-zone__content" id="upload-label">
                    <?php if (!empty($product['img']) && !str_starts_with($product['img'], 'http')): ?>
                        <img src="<?= htmlspecialchars($product['img']) ?>"
                             alt="preview" class="upload-zone__preview" id="preview">
                    <?php else: ?>
                        <span class="upload-zone__text">Glissez une image ou <u>cliquez sur</u> "Choisir un fichier"</span>
                        <img id="preview" class="upload-zone__preview" style="display:none" alt="preview">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form__actions">
            <button type="submit" class="btn btn--primary">💾 Enregistrer</button>
            <a href="index.php?action=products" class="btn btn--secondary">Annuler</a>
        </div>
    </form>
</div>

<script>
const input   = document.getElementById('img_file');
const preview = document.getElementById('preview');
const zone    = document.getElementById('upload-zone');
const urlInput = document.getElementById('img-url');

function showPreview(file) {
    if (!file) return;
    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
    document.querySelector('.upload-zone__icon') ?.remove();
    document.querySelector('.upload-zone__text') ?.remove();
    urlInput.value = '';
}

input.addEventListener('change', () => showPreview(input.files[0]));

zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('upload-zone--drag'); });
zone.addEventListener('dragleave', ()  => zone.classList.remove('upload-zone--drag'));
zone.addEventListener('drop', e => {
    e.preventDefault();
    zone.classList.remove('upload-zone--drag');
    input.files = e.dataTransfer.files;
    showPreview(e.dataTransfer.files[0]);
});
</script>

<?php $content = ob_get_clean();
require __DIR__ . '/../layout/layout.php'; ?>
