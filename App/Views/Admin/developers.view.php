<?php

/** @var Developer[] $developers */
/** @var View $view */

/** @var LinkGenerator $link */

use App\Models\Developer;
use Framework\Support\LinkGenerator;
use Framework\Support\View;

$view->setLayout('admin');
?>

<h1>Správa vývojárov</h1>

<div class="add-developer">
    <input type="checkbox" id="add-developer-toggle" class="add-developer-toggle">
    <label for="add-developer-toggle" class="add-developer-button">
        Pridať nového vývojára
    </label>
    <form method="POST"
          action="<?= $link->url('developer.save') ?>"
          class="add-developer-form">
        <label>
            Názov:
            <input type="text" name="name" required>
        </label>
        <label>
            Krajina:
            <input type="text" name="country">
        </label>
        <label>
            Webová stránka:
            <input type="url" name="website">
        </label>
        <button type="submit" class="save-button">Uložiť</button>
        <label for="add-developer-toggle" class="cancel-button">
            Zrušiť
        </label>
    </form>
</div>

<table class="developer-table">
    <tr>
        <th>Názov</th>
        <th>Krajina</th>
        <th>Webová stránka</th>
        <th>Akcie</th>
    </tr>

    <?php foreach ($developers as $developer) { ?>

        <?php
        $id = $developer->getId();
        $checkboxId = 'edit-' . $id;
        $formId = 'developer-form-' . $id;
        ?>

        <tbody class="developer-entry">

        <tr class="developer-row">
            <td><?= e($developer->getName()) ?></td>
            <td><?= e($developer->getCountry()) ?></td>
            <td><?= e($developer->getWebsite()) ?></td>
            <td>
                <input type="checkbox" id="<?= e($checkboxId) ?>" class="edit-toggle">
                <label for="<?= e($checkboxId) ?>" class="edit-button">
                    Upraviť
                </label>

                <form method="POST" action="<?= $link->url('developer.delete') ?>" class="delete-form"
                      onsubmit="return confirm('Naozaj chcete vymazať tohto vývojára?');">
                    <input type="hidden" name="id" value="<?= e($id) ?>">
                    <button type="submit" class="delete-button">
                        Vymazať
                    </button>
                </form>
            </td>
        </tr>

        <tr class="developer-edit-row">
            <td>
                <form id="<?= e($formId) ?>" method="POST" action="<?= $link->url('developer.save') ?>">
                    <input type="hidden" name="id" value="<?= e($id) ?>">
                </form>
                <label>
                    <input type="text" name="name" form="<?= e($formId) ?>" value="<?= e($developer->getName()) ?>"
                           required>
                </label>
            </td>
            <td>
                <label>
                    <input type="text" name="country" form="<?= e($formId) ?>"
                           value="<?= e($developer->getCountry()) ?>">
                </label>
            </td>
            <td>
                <label>
                    <input type="url" name="website" form="<?= e($formId) ?>"
                           value="<?= e($developer->getWebsite()) ?>">
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