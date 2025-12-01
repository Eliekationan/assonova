<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MembreController extends Controller
{
    //
    public function index(){
        return Inertia::render('Member/Index');
    }

    public function insert(){
        return Inertia::render('Member/AddMember');
    }
    public function invite(){
        return Inertia::render('Member/InviteMember');
    }
}
