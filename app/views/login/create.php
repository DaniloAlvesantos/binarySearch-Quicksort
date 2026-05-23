<?php
$message = $_REQUEST["message"] ?? "";
?>


<section class="mx-auto" style="max-width: 400px; margin-top: 50px;">
    <h1 class="text-center mb-4">Cadastro</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center" role="alert">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/index.php?action=create:user">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="email@gmail.com" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@gmail.com" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="pass" placeholder="Sua senha..." required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Entrar</button>
        <a href="<?= BASE_URL ?>/index.php?action=login">Login</a>
    </form>
</section>