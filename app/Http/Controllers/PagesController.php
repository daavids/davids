<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $data = array(
            'heading'=>'Welcome',
            'technologies'=>['PHP7 (Laravel)', 
                            'HTML5', 
                            'CSS3 (SASS, Bootstrap4)', 
                            'JavaScript (Vue)',
                            'MySQL'],
            'todo'=>['More games?', 
                    'Project section', 
                    'Template customisation',
                    'Design',
                    'Remake landing page'],
            'done'=>['Blog - browse, edit, create, delete posts', 
                    'User registration',
                    'Navigation (sort of)',
                    'Games: Tic-Tac-Toe, Minesweeper']
        );
        return view('pages.index')->with($data);
    }

    public function games() {
        $data = array(
            'heading'=>'HTML5 and JavaScript games',
            'games'=>['Tic-Tac-Toe', 'Minesweeper']
        );
        return view('pages.games')->with($data);
    }
}
