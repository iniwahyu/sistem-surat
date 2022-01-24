<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Load Library

// Load Model

class Dashboard extends Controller
{
    private $views      = '/dashboard';
    private $url        = "/dashboard";

    public function __construct()
    {

    }

    public function index()
    {
        // Variable
        $title = 'Dashboard';
        $url = $this->url;

        // Get Data

        // View
        return view("$this->views/index", compact('title', 'url'));
    }
}