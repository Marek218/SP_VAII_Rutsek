<?php

/** @var \App\Models\Developer[] $developers */
/** @var \Framework\Support\View $view */
/** @var \Framework\Support\LinkGenerator $link */

$view->setLayout('admin');
?>

<h1>Správa vývojárov</h1>

<table class="developer-table">
    <thead>
    <tr>
        <th>Názov</th>
        <th>Krajina</th>
        <th>Webstránka</th>
        <th>Akcie</th>
    </tr>
    </thead>

    <?php foreach ($developers as $developer) { ?>

        <?php
        $id = $developer->getId();
        $checkboxId = 'edit-' . $id;
        $formId = 'developer-form-' . $id;
        ?>

        <tbody class="developer-entry">

        <!-- Checkbox a normálny riadok -->
        <tr class="developer-row">
            <td><?= e($developer->getName()) ?></td>
            <td><?= e($developer->getCountry()) ?></td>
            <td><?= e($developer->getWebsite()) ?></td>
            <td>
                <input type="checkbox" id="<?= e($checkboxId) ?>" class="edit-toggle">
                <label for="<?= e($checkboxId) ?>" class="edit-button">
                    Upraviť
                </label>
            </td>
        </tr>

        <tr class="developer-edit-row">
            <td>
                <form id="<?= e($formId) ?>" method="POST" action="<?= $link->url('developer.save') ?>">
                    <input type="hidden" name="id" value="<?= e($id) ?>">
                </form>
                <label>
                    <input type="text" name="name" form="<?= e($formId) ?>" value="<?= e($developer->getName()) ?>" required>
                </label>
            </td>

            <td>
                <label>
                    <input type="text" name="country" form="<?= e($formId) ?>" value="<?= e($developer->getCountry()) ?>">
                </label>
            </td>
            <td>
                <label>
                    <input type="url" name="website" form="<?= e($formId) ?>" value="<?= e($developer->getWebsite()) ?>">
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