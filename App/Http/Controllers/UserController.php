<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Exceptions\ValidationsException;
use App\Http\Middleware\Authenticate;
use App\Http\Request\Request;
use App\Http\Validate\Validate;
use App\Models\User;
use App\Response\ResponseHandler;

class UserController
{
    use ResponseHandler;

    /**
     * @var User
     */
    private $user;

    /**|
     * @var Request
     */
    public $request;

    public function __construct()
    {
        $this->user    = new User();
        $this->request = new Request;
    }

    public function profile()
    {
        try {
            $authenicate = new Authenticate();

            return $this->successResponse($authenicate->user());
        } catch (UnauthorizedException $e) {
            return $this->unauthorizedResponse();
        } catch (\Exception $e) {
            return $this->serviceErrorResponse();
        }
    }

    public function updateProfile()
    {
        try {
            if ($this->request->isMethodPUT()) {
                $authenicate = new Authenticate();

                // check validate
                Validate::validateUpdateProfile($this->request);

                $user = $this->user->update($authenicate->user()['id'], $this->request->getDataRequest());
                return $this->successResponse($user);
            }

            return $this->methodNotAllowResponse();
        } catch (UnauthorizedException $e) {
            return $this->unauthorizedResponse();
        } catch (ValidationsException $e) {
            return $this->errorResponse([
                'errors' => ['authen' => $e->getMessage()]
            ]);
        } catch (\Exception $e) {
            return $this->serviceErrorResponse();
        }
    }
}
