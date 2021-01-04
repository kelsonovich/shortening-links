<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\ShortLinks;

class GenerateController extends Controller
{
  private $dictonary = [
    0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
    'J',  'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U',  'V', 'W',
    'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
    'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
  ];

  public function generate(Request $link)
  {
    $flag = false;
    while(!$flag){
      $newLink = '';
      for ($i = 0; $i < 6; $i++) {
        $newLink .= $this->dictonary[rand(0, 61)];
      }
      $flag = (ShortLinks::where('newLink', $newLink)->count() === 0)
        ? true
        : false;
    }

    ShortLinks::insert([
      'oldLink' => $link->input('link'),
      'newLink' => $newLink
    ]);

    return redirect()->route('welcome')->with('success', $newLink);
  }

  public function redirect($newLink)
  {
    $check = ShortLinks::where('newLink', $newLink)->first();
    return ($check === NULL)
      ? redirect()->route('welcome')->with('danger', $newLink)
      : Redirect::to($check->oldLink);
  }
}
