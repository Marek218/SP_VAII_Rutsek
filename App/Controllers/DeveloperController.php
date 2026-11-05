<?php

namespace App\Controllers;

use App\Models\Developer;
use App\Models\Game;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class DeveloperController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn();
    }

    public function index(Request $request): Response
    {
        return $this->html(['developers' => Developer::getAll()]);
    }

    public function edit(Request $request): Response
    {
        return $this->html(['developer' => $this->findDeveloper($request)]);
    }
    public function save(Request $request): Response
    {
        $developer = (int)$request->value('id') > 0
            ? $this->findDeveloper($request)
            : new Developer();

        $developer->setFromRequest($request);
        $developer->save();

        return $this->redirect($this->url('admin.developers'));
    }

    private function findDeveloper(Request $request): Developer
    {
        $developer = Developer::getOne((int)$request->value('id'));
        if ($developer === null) {
            throw new HttpException(404, 'Developer not found.');
        }
        return $developer;
    }
}