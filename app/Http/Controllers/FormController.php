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

    $inputArray = explode(" ", $input);

    $isAgeEnd = false;

    foreach ($inputArray as $word) {
        if ($isAgeEnd && !($word == "THN" || $word == "TAHUN" || $word == "TH") && !strpos($word, "TH") && !strpos($word, "THN") && !strpos($word, "TAHUN")) {
            $city .= $word . " ";
        }else if (ctype_alpha($word) && !($word == "THN" || $word == "TAHUN" || $word == "TH") && !strpos($word, "TH") && !strpos($word, "THN") && !strpos($word, "TAHUN")) {
            if (!$isAgeEnd) {
                $name .= $word . " ";
            }
        } elseif (!ctype_alpha($word) || ($word == "THN" || $word == "TAHUN" || $word == "TH") || strpos($word, "TH") || strpos($word, "THN") || strpos($word, "TAHUN")) {
            if (!$isAgeEnd) {
                $age = preg_replace('/[^0-9]/', '', $word);
                $isAgeEnd = true;
            }
        } 
    }
    


    // Hapus spasi 
    $name = trim($name);
    $age = trim($age);
    $city = trim($city);

    // Simpan data
    Form::create([
        'name' => $name,
        'age' => $age,
        'city' => $city,
    ]);

    return "Data saved successfully.";
}

}
