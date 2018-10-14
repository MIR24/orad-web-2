<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $tabs = [
                ['id' => 1, 'title' => 'Топы', 'component' => 'tops'],
                ['id' => 2, 'title' => 'Newsbar', 'component' => 'newsbar'],
                ['id' => 3, 'title' => 'Срочно', 'component' => 'urgent'],
                ['id' => 4, 'title' => 'Срочно (орбиты)', 'component' => 'urgentorbit'],
                ['id' => 5, 'title' => 'Бегущая строка', 'component' => 'ticker'],
                ['id' => 6, 'title' => 'Фото', 'component' => 'photo'],
                ['id' => 7, 'title' => 'Промо', 'component' => 'promo'],
                ['id' => 8, 'title' => 'Курс валют', 'component' => 'currency'],
                // {id:9, title:'Погода', component: 'weather'},
            ];
        return view('layouts.metronic', ['sections' => $tabs]);
    }

    public function getSection($name)
    {

        return view($name);
    }
}
