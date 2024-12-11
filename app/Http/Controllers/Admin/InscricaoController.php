<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InscricaoController extends Controller
{
    public function index()
    {
        return view('admin.inscricao.inscricao');
    }

    public function createAdd()
    {
        return view('admin.inscricao.create');
    }
}
