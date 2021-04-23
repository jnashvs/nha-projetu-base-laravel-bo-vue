<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Artesaos\SEOTools\Facades\SEOTools;
use SEOMeta;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pagina = ["aqui vai o titulo da pagina", "<p>aqui vai a <b>descricao</b> de teste da pagina</p>", "www.cm-tvedras.pt/assets/upload/banners/2021/04/19/headercmtvedrascac/headercmtvedrascac.jpg"];

        SEOMeta::setTitle('HackTheStuff - Homepage');
        SEOMeta::setDescription('One destination for all stuff');
        SEOMeta::setCanonical('https://hackthestuff.com/');

        //$this->setSeo($pagina);

        return view('home');

    }

    private function setSeo($pagina)
    {
       //$descricao = html_entity_decode($pagina->descricao);
       $descricao = substr(strip_tags($pagina[1]), 0, 300);

        SEOTools::setTitle($pagina[0]);
        SEOTools::setDescription($descricao);

        $img = $pagina[2];

        OpenGraph::setTitle($pagina->titulo);
        OpenGraph::setDescription($descricao);
        OpenGraph::addImage($img, ['height' => 300, 'width' => 300]);
    }
}
