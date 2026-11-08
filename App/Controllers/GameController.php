<?php

namespace App\Controllers;

use App\Models\Developer;
use App\Models\Game;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\HttpException;

class GameController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn();
    }

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->html(['games' => Game::getAll()]);
    }

    /**
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $name = trim((string)$request->value('name'));
        $releaseDate = filter_var(
            $request->value('release_date'),
            FILTER_VALIDATE_INT
        );
        $coverImage = trim((string)$request->value('cover_image'));
        $developerId = filter_var(
            $request->value('developer_id'),
            FILTER_VALIDATE_INT
        );
        $description = trim((string)$request->value('description'));

        if ($name === '' || mb_strlen($name) > 100) {
            throw new HttpException(400, 'Názov hry je povinný a môže mať najviac 100 znakov.');
        }

        if ($releaseDate === false || $releaseDate < 1 || $releaseDate > (int)date('Y')) {
            throw new HttpException(400, 'Rok vydania nie je platný.');
        }

        if ($coverImage === '' || mb_strlen($coverImage) > 250) {
            throw new HttpException(400, 'Obrázok obalu je povinný a môže mať najviac 100 znakov.');
        }

        if ($developerId === false || Developer::getOne($developerId) === null) {
            throw new HttpException(400, 'Vybraný developer neexistuje.');
        }

        if ($description === '' || mb_strlen($description) > 100) {
            throw new HttpException(400, 'Popis hry je povinný a môže mať najviac 100 znakov.');
        }

        $game = (int)$request->value('id') > 0
            ? $this->findGame($request)
            : new Game();

        $game->setName($name);
        $game->setReleaseDate($releaseDate);
        $game->setCoverImage($coverImage);
        $game->setDeveloperId($developerId);
        $game->setDescription($description);
        $game->save();

        return $this->redirect($this->url('admin.games'));
    }

    /**
     * @throws Exception
     */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $this->findGame($request)->delete();

        return $this->redirect($this->url('admin.games'));
    }

    /**
     * @throws Exception
     */
    private function findGame(Request $request): Game
    {
        $game = Game::getOne((int)$request->value('id'));
        if ($game === null) {
            throw new HttpException(404, 'Game not found.');
        }

        return $game;
    }
}