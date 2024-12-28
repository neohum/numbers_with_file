<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NumberSchool;
use App\Models\NumberSchool1s;
use Illuminate\Support\Facades\DB;




class NumberMakeController extends Controller
{
    public $school_code, $school_name;
    public function index()
    {
        return view('numbers.index');
    }

    public function make()
    {
        return view('numbers.make');
    }

    public function first_number(Request $request)
    {
        $schoolcode = $request->schoolcode;
        $schoolname = $request->schoolname;
        return view('numbers.first_number', compact('schoolcode', 'schoolname'));
    }


    public function save(Request $request)
    {
        $hex = 'l' . bin2hex(random_bytes(20));
        $request->schoolname;


    $school = new NumberSchool;
    $school->schoolcode = $hex;
    $school->schoolname = $request->schoolname;
    $school->save();
    //dd($hex);
    return redirect()->route('first_number', ['schoolcode' => $hex, 'schoolname' => $request->schoolname])
        ->with('success', '학교 정보가 등록되었습니다.');
    }

    public function list(Request $request)
    {
        $schoolname = $request->schoolname;
        $schoolcode = $request->schoolcode;
        $created_ats = $request->created_ats;
        $page = $request->page;


    $schools = DB::table('number_school1s')
      ->where('schoolname', $schoolname)
      ->where('schoolcode', $schoolcode)
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    $schools->appends(['schoolcode' => $schoolcode, 'schoolname' => $schoolname]);


    $prev_number1 = DB::table('number_school1s') 
      ->where('schoolcode', $schoolcode)
      ->where('schoolname', $schoolname)
      ->orderBy('created_ats', 'desc')
      ->first();
      //dd($prev_number1);
        return view('numbers.list', compact('schools', 'prev_number1', 'schoolname', 'schoolcode', 'created_ats'));
    }

    public function first_number_save(Request $request) {
      
      
      $schoolcode = $request->schoolcode;
      $schoolname = $request->schoolname;
      $content = $request->content;
      $number = $request->number;
      $created_ats = date('Y');

      $request->validate([
            'file' => 'required|file|mimes:hwp,hwpx,pdf|max:10240',
        ]);
        if ($request->file('file')->isValid()) {
            // Store the file in the 'uploads' directory on the 'public' disk
            $filePath = $request->file('file')->store('uploads', 'public');
            // Return success response

        } else {
            return redirect()->route('numbers.list', ['schoolcode' => $schoolcode, 'schoolname' => $schoolname])
                ->with('error', '파일 업로드는 10MB 이하만 가능합니다.');
        }

      
      $school = new NumberSchool1s();
      $school->schoolcode = $schoolcode;
      $school->schoolname = $schoolname;
      $school->number = $number;
      $school->content = $content;
      $school->file = $filePath;
      $school->created_ats = $created_ats;
      $school->save();
      return redirect()->route('numbers.list', ['schoolcode' => $schoolcode, 'schoolname' => $schoolname])
        ->with('success', '학교 정보가 등록되었습니다.');}

    public function content_save(Request $request)
    {

        $schoolcode = $request->schoolcode;
        $schoolname = $request->schoolname;
        $content = $request->content;
    $number = DB::table('number_school1s')
      ->where('schoolcode', $schoolcode)
      ->where('schoolname', $schoolname)
      ->orderBy('created_at', 'desc')
      ->first();

      
         $number = $number->number;
        $created_ats = date('Y');
        //$created_ats = 2005;

            //dd($number);
        $created_ats_now = date('Y');
        
        if ($created_ats_now != $created_ats) {
            $number = 0;
        }

        
      
        $number = $number+1;
        
        $request->validate([
            'file' => 'required|file|mimes:hwp,hwpx,pdf|max:10240',
        ]);
    if ($request->file('file')->isValid()) {
      // Store the file in the 'uploads' directory on the 'public' disk
      $filePath = $request->file('file')->store('uploads', 'public');
      // Return success response

    } else {
            return redirect()->route('numbers.list', ['schoolcode' => $schoolcode, 'schoolname' => $schoolname])
                ->with('error', '파일 업로드는 10MB 이하만 가능합니다.');
        }

        $school = new NumberSchool1s();
        $school->schoolcode = $schoolcode;
        $school->schoolname = $schoolname;
        $school->number = $number;
        $school->content = $content;
        $school->file = $filePath;
        $school->created_ats = $created_ats;
        $school->save();
        return redirect()->route('numbers.list', ['schoolcode' => $schoolcode, 'schoolname' => $schoolname])
            ->with('success', '학교 정보가 등록되었습니다.');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $school = NumberSchool1s::find($id);
        return view('numbers.edit', compact('school'));
    }

    public function content_update(Request $request) 
    {
        $schoolcode = $request->schoolcode;
        $schoolname = $request->schoolname;
        $content = $request->content;
        $id = $request->id;

        $school = NumberSchool1s::find($id);
        $school->content = $content;
        $school->save();
        return redirect()->route('numbers.list', ['schoolcode' => $schoolcode, 'schoolname' => $schoolname])
            ->with('success', '학교 정보가 수정되었습니다.');
    }
}
