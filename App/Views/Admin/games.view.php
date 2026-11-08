<?php
/** @var \App\Models\Game[] $games */
/** @var \App\Models\Developer[] $developers */
/** @var \Framework\Support\View $view */

/** @var \Framework\Support\LinkGenerator $link */

use App\Models\Developer;

$view->setLayout('admin');
?>

<h1>Správa hier</h1>

<div class="add-game">
    <input type="checkbox" id="add-game-toggle" class="add-game-toggle">
    <label for="add-game-toggle" class="add-game-button">
        Pridať novú hru
    </label>
    <form method="POST"
          action="<?= $link->url('game.save') ?>"
          class="add-game-form">
        <label>
            Názov:
            <input type="text" name="name" required>
        </label>
        <label>
            Rok vydania:
            <input type="number" name="release_date" min="1" required>
        </label>
        <label>
            Obrázok obalu:
            <input type="text" name="cover_image" required>
        </label>
        <label>
            Vývojár:
            <select name="developer_id" required>
                <option value="" disabled selected>Vyberte vývojára</option>
                <?php foreach ($developers as $developer) { ?>
                    <option value="<?= e($developer->getId()) ?>">
                        <?= e($developer->getName()) ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <label>
            Popis:
            <textarea name="description" required></textarea>
        </label>
        <button type="submit" class="save-button">Uložiť</button>
        <label for="add-game-toggle" class="cancel-button">
            Zrušiť
        </label>
    </form>
</div>

<table class="game-table">
    <tr>
        <th>Názov</th>
        <th>Rok vydania</th>
        <th>Obrázok obalu</th>
        <th>Vývojár</th>
        <th>Popis</th>
        <th>Akcie</th>
    </tr>

    <?php foreach ($games as $game) { ?>
        <?php
        $id = $game->getId();
        $checkboxId = 'edit-game-' . $id;
        $formId = 'game-form-' . $id;
        $developer = $game->getOneRelated(Developer::class, 'developer_id');
        ?>

        <tbody class="game-entry">
        <tr class="game-row">
            <td><?= e($game->getName()) ?></td>
            <td><?= e($game->getReleaseDate()) ?></td>
            <td class="game-cover-cell">
                <?php if ($game->getCoverImage()) { ?>
                    <img
                            class="game-cover-image"
                            src="<?= e($game->getCoverImage()) ?>"
                            alt="Obal hry <?= e($game->getName()) ?>"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                    >
                    <span class="game-cover-fallback">Obrázok sa nepodarilo načítať</span>
                <?php } else { ?>
                    <span class="game-cover-fallback">Bez obrázka</span>
                <?php } ?>
            </td>
            <td><?= e($developer?->getName()) ?></td>
            <td><?= e($game->getDescription()) ?></td>
            <td>
                <input type="checkbox" id="<?= e($checkboxId) ?>" class="edit-toggle">
                <label for="<?= e($checkboxId) ?>" class="edit-button">
                    Upraviť
                </label>

                <form method="POST" action="<?= $link->url('game.delete') ?>" class="delete-form"
                      onsubmit="return confirm('Naozaj chcete vymazať túto hru?');">
                    <input type="hidden" name="id" value="<?= e($id) ?>">
                    <button type="submit" class="delete-button">
                        Vymazať
                    </button>
                </form>
            </td>
        </tr>

        <tr class="game-edit-row">
            <td>
                <form id="<?= e($formId) ?>" method="POST" action="<?= $link->url('game.save') ?>">
                    <input type="hidden" name="id" value="<?= e($id) ?>">
                </form>
                <label>
                    <input type="text" name="name" form="<?= e($formId) ?>"
                           value="<?= e($game->getName()) ?>" required>
                </label>
            </td>
            <td>
                <label>
                    <input type="number" name="release_date" form="<?= e($formId) ?>"
                           value="<?= e($game->getReleaseDate()) ?>" min="1" required>
                </label>
            </td>
            <td>
                <label>
                    <input type="text" name="cover_image" form="<?= e($formId) ?>"
                           value="<?= e($game->getCoverImage()) ?>" required>
                </label>
            </td>
            <td>
                <label>
                    Vývojár:
                    <select name="developer_id" form="<?= e($formId) ?>" required>
                        <option value="" disabled>Vyberte vývojára</option>

                        <?php foreach ($developers as $developerOption) { ?>
                            <option value="<?= e($developerOption->getId()) ?>"
                                    <?= (int)$developerOption->getId() === (int)$game->getDeveloperId()
                                            ? 'selected'
                                            : '' ?>>
                                <?= e($developerOption->getName()) ?>
                            </option>
                        <?php } ?>
                    </select>
                </label>
            </td>
            <td>
                <label>
                    <textarea name="description" form="<?= e($formId) ?>" required>
                        <?= e($game->getDescription()) ?></textarea>
                </label>
            </td>
            <td>
                <button type="submit" form="<?= e($formId) ?>">
                    Uložiť
                </button>
                <label for="<?= e($checkboxId) ?>" class="cancel-button">
                    Zrušiť
                </label>
            </td>
        </tr>
        </tbody>
    <?php } ?>
</table>
