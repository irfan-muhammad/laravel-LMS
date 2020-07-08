<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\FlashMessages;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FlashMessages;

    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }
    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false, $id=null)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }
        if($id){
            return redirect()->route($route, $id);
        }
        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }
}
