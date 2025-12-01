<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CotisationController extends Controller
{
    //
    public function index(){
        return Inertia::render('Cotisation/Index');

    }
    public function newRule(){
        return Inertia::render('Cotisation/AddNewRule');
    }
    public function rulesList(){
        return Inertia::render('Cotisation/RulesList');
    }
}
