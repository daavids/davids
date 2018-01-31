<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class PagesController extends Controller
{
    public function index() {
        $projects = Project::all();
        $data = array(
            'heading'=>'Dāvids Gabaliņš',
            'skills'=>['PHP7 (Laravel)', 
                        'HTML5', 
                        'CSS3 (SASS, Bootstrap, W3CSS)', 
                        'JavaScript (jQuery, VueJS)',
                        'MySQL',
                        'GIT', 
                        'Basic sysadmin skills (setting up mail clients, domains, hosting etc.)'],
            'projects'=>$projects      
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
