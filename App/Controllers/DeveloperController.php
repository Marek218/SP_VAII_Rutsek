<?php

namespace App\Controllers;

use App\Models\Developer;
use App\Models\Game;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\HttpException;

class DeveloperController extends BaseController
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
        return $this->html(['developers' => Developer::getAll()]);
    }

    /**
     * Saves the developer.
     *
     * @throws HttpException
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $name = trim((string)$request->value('name'));
        $country = trim((string)$request->value('country'));
        $website = trim((string)$request->value('website'));

        if ($name === '') {
            throw new HttpException(400, 'Názov developera je povinný.');
        }

        if (mb_strlen($name) > 100) {
            throw new HttpException(400, 'Názov developera môže mať najviac 100 znakov.');
        }

        if (mb_strlen($country) > 100) {
            throw new HttpException(400, 'Krajina môže mať najviac 100 znakov.');
        }

        if ($website !== '' && !filter_var($website, FILTER_VALIDATE_URL)) {
            throw new HttpException(400, 'Webová stránka nemá platný formát.');
        }

        if (mb_strlen($website) > 250) {
            throw new HttpException(400, 'Webová stránka môže mať najviac 250 znakov.');
        }

        $developer = (int)$request->value('id') > 0
            ? $this->findDeveloper($request)
            : new Developer();

        $developer->setName($name);
        $developer->setCountry($country);
        $developer->setWebsite($website);
        $developer->save();

        return $this->redirect($this->url('admin.developers'));
    }

    /**
     * @throws HttpException
     * @throws Exception
     */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $this->findDeveloper($request)->delete();

        return $this->redirect($this->url('admin.developers'));
    }
    /**
     * Loads the developer identified by the `id` request parameter.
     *
     * @throws HttpException|Exception If the developer does not exist.
     */
    private function findDeveloper(Request $request): Developer
    {
        $developer = Developer::getOne((int)$request->value('id'));
        if ($developer === null) {
            throw new HttpException(404, 'Developer not found.');
        }
        return $developer;
    }
}