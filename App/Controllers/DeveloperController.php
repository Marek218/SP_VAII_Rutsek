<?php

namespace App\Controllers;

use App\Models\Developer;
use App\Models\Game;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use HttpException;

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
        $developer = (int)$request->value('id') > 0 ? $this->findDeveloper($request) : new Developer();
        $developer->setFromRequest($request);
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