<?php

namespace App\Http\Controllers;

use App\Exceptions\Page\PageAlreadyRegisteredException;
use App\Models\Page;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class PageController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'text' => 'required|max:2023',
            'link' => 'required|alpha_dash|max:255'
        ]);

        try {

            $this->checkLinkIsFree($validated['link']);

            Page::store($validated);

        } catch (\Exception $exception) {
            return view('add-page', [
                'title' => $validated['title'],
                'text' => $validated['text'],
                'link' => $validated['link'],
                'message' => $exception->getMessage(),
                'infoPages' => Page::getAll()
            ]);
        }

        return redirect('admin-panel');
    }

    public function updateById(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|min:1',
            'title' => 'required|max:255',
            'text' => 'required|max:2023',
            'link' => 'required|max:255'
        ]);

        try {
            Page::updateById($validated);
        } catch (Exception $exception) {

        }

        return redirect('admin-panel');
    }


    public function getPageByLink(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'link' => 'required|max:255'

        ])->validate();

        $page = Page::getByLink($validated['link']);

        return view('info-page', [
            'page' => $page,
            'infoPages' => Page::getAll()
        ]);
    }

    public function deleteById(Request $request)
    {
        $validated = validator($request->route()->parameters(), [

            'page' => 'required'

        ])->validate();

        Page::deleteById($validated['page']);

        return redirect('admin-panel');
    }

    /**
     * @throws PageAlreadyRegisteredException
     */
    private function checkLinkIsFree($link): void
    {
        $routes = require_once dirname(__DIR__, 3).'/routes/RegisteredRoutes.php';
        if(in_array($link, $routes)) {
            throw new PageAlreadyRegisteredException("Страница уже зарегистрированна!");
        }
    }
}
