<?php
use App\Models\Author;
/** @var Author[] $authors */
$authors = $_REQUEST['authors'];
?>

<section class="container-fluid">
    <div class="row">
        <?php foreach ($authors as $author): ?>
            <div class="card col-md-3 p-2 m-3">
                <div class="card-body">
                    <a class="card-title h5 d-block mb-3" href="<?= BASE_URL ?>/index.php?action=author&a=<?= $author->getId(); ?>">
                        <?= $author->getName(); ?>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>