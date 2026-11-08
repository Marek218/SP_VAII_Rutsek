<?php

namespace App\Controllers;

use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class AdminController
 *
 * This controller manages admin-related actions within the application.It extends the base controller functionality
 * provided by BaseController.
 *
 * @package App\Controllers
 */
class AdminController extends BaseController
{
    /**
     * Authorizes actions in this controller.
     *
     * This method checks if the user is logged in, allowing or denying access to specific actions based
     * on the authentication state.
     *
     * @param string $action The name of the action to authorize.
     * @return bool Returns true if the user is logged in; false otherwise.
     */
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn();
    }

    /**
     * Displays the index page of the admin panel.
     *
     * This action requires authorization. It returns an HTML response for the admin dashboard or main page.
     *
     * @return Response Returns a response object containing the rendered HTML.
     */

    public function index(Request $request): Response
    {
        return $this->html();
    }

    /**
     * @throws Exception
     */
    public function games(Request $request): Response
    {
        return $this->html(['games' => \App\Models\Game::getAll(), 'developers' => \App\Models\Developer::getAll()]);
    }

    /**
     * @throws Exception
     */
    public function developers(Request $request): Response
    {
        return $this->html(['developers' => \App\Models\Developer::getAll()]);
    }

}
