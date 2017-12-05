<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $data = array(
            'title'=>'David',
            'technologies'=>['PHP7 (Laravel)', 
                            'HTML5', 
                            'CSS3 (SASS, Bootstrap4)', 
                            'JavaScript (jQuery, Vue)',
                            'MySQL'],
            'todo'=>['Games - Tic-Tac-Toe, Minesweeper, ???', 
                    'Website section', 
                    'Template customisation',
                    'Design',
                    'Remake landing page'],
            'done'=>['Blog - browse, edit, create, delete posts', 
                    'User registration',
                    'Navigation (kinda)']
        );
        return view('pages.index')->with($data);
    }
    public function laravel() {
        return view('welcome');
    }
}
