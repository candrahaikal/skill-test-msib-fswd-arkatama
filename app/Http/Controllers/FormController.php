<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Form;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FormController extends Controller
{
    public function index(): View
    {
        //get posts
        $posts = Form::latest()->paginate(5);

        //render view with posts
        return view('formIndex', compact('form'));
    }


    public function create(): View
    {
        return view('inputForm');
    }


    public function store(Request $request)
    {
        $input = $request->input('data');
        $input = strtoupper($input);

        $name = '';
        $age = '';
        $city = '';

        // Pisahkan kalimat menjadi kata-kata
    $inputArray = explode(' ', $input);

    // Flag untuk menandai kapan mulai mengisi variabel usia
    $isAge = false;

    foreach ($inputArray as $word) {
        if (ctype_digit($word) && !$isAge) {
            $name .= $word . " ";
        } elseif (preg_match('/(\d+)\s*(TAHUN|THN|TH)$/i', $word, $ageString)) {
            $age .= $ageString[1] . " "; // Menggunakan .= untuk mengakumulasi angka
            $isAge = true;
        } else {
            $isAge ? $city .= $word . " " : $name .= $word . " ";
        }
    }

    $name = trim($name);
    $age = trim($age);
    $city = trim($city);

        // Simpan data ke database
        Form::create([
            'name' => $name,
            'age' => $age,
            'city' => $city,
        ]);

        return "Data saved successfully.";
    }
}
