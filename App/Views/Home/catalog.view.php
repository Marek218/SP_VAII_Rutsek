<?php

/** @var \App\Models\Game[] $games */
/** @var \Framework\Support\LinkGenerator $link */
?>

<main class="body-content catalog-page">
    <section class="catalog-header">
        <div>
            <h1>Katalóg hier</h1>
            <p>Objav príbehy, ku ktorým sa budeš chcieť vracať.</p>
        </div>
    </section>

    <?php if ($games === []) { ?>
        <section class="catalog-empty">
            <h2>Katalóg je zatiaľ prázdny</h2>
            <p>Hry bude možné zobraziť po ich pridaní v administrácii.</p>
        </section>
    <?php } else { ?>
        <section class="catalog-grid" aria-label="Katalóg hier">
            <?php foreach ($games as $game) {
                $coverImage = $game->getCoverImage();
                $developer = $game->getOneRelated(\App\Models\Developer::class, 'developer_id');
                ?>
                <article class="catalog-card">
                    <div class="catalog-cover">
                        <img src="<?= e($coverImage) ?>" alt="Obal hry <?= e($game->getName()) ?>">
                    </div>
                    <div class="catalog-card-content">
                        <div class="catalog-card-meta">
                            <span><?= e($game->getReleaseDate()) ?></span>
                            <?php if ($developer) { ?>
                                <span><?= e($developer->getName()) ?></span>
                            <?php } ?>
                        </div>
                        <h2><?= e($game->getName()) ?></h2>
                        <p><?= e($game->getDescription()) ?></p>
                        <a class="catalog-card-link" href="">
                            pridat do Zoznamu a/alebo do wishlistu
                        </a>
                    </div>
                </article>
            <?php } ?>
        </section>
    <?php } ?>
</main>