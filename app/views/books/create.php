<?php
$message = $_REQUEST["message"] ?? $_GET['message'] ?? "";
?>


<section class="mx-auto" style="max-width: 400px; margin-top: 50px;">
    <h1 class="text-center mb-4">Cadastro Livro</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/index.php?action=create:book">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do livro..." required>
        </div>

        <div class="mb-3">
            <label for="numberOfPages" class="form-label">Número de páginas</label>
            <input type="number" class="form-control" id="numberOfPages" name="numberOfPages" placeholder="320" required>
        </div>

        <div class="mb-3 input-group">
            <label for="price" class="form-label col-12">Preço</label>
            <span class="input-group-text">R$</span>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="20.0" required>
        </div>

        <div class="mb-3">
            <label for="pubYear" class="form-label">Ano de publicação</label>
            <input type="number" class="form-control" id="pubYear" name="pubYear" placeholder="2014" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea type="text" class="form-control" id="description" name="description" placeholder="Descrição do livro..." required></textarea>
        </div>

        <div class="mb-3">
            <label for="authors" class="form-label">Autores</label>
            <input type="text" class="form-control" id="authors" name="authors" placeholder="Autores do livro..." required>
            <span>Separe os autores por vírgula.</span>
        </div>

        <div class="mb-3">
            <label for="genres" class="form-label">Gêneros</label>
            <input type="text" class="form-control" id="genres" name="genres" placeholder="Autores do livro..." required>
            <span>Separe os autores por vírgula.</span>
        </div>

        <button type="submit" class="btn btn-primary col-12">Cadastrar</button>
    </form>
</section>