<?php

namespace App\Livewire;

use Livewire\Component;

use Illuminate\Http\Request;
use App\Models\Contents;
use Carbon\Carbon;




class NumberList extends Component
{

     public $schools= [];

     public $schoolname, $hex_address, $content, $number;
     public $prev_number;
     public $prev_number1;

    public $created_ats;

    public $list;

  public $numbers;

  public $prev_date;

  public $next_year;

  public $day;

     protected $rules = [
        'number' => 'required',
        'schoolname' => 'required',
        'hex_address' => 'required',
        'content' => 'required',
        'created_ats' => 'required',
        'numbers' => 'required',
    ];

   


     public function mount(Request $request){

        $this->schoolname = $request->query('schoolname');
        $this->hex_address = $request->query('code');
        //$this->numbers = $request->query('numbers');
        $this->created_ats = Carbon::now();

        $this->schools = Contents::all()
          ->where('hex_address', $this->hex_address)
          ->where('schoolname', $this->schoolname)
          ->sortByDesc('created_at')
          ->take(10);

        $prev_number = Contents::where('hex_address', $this->hex_address)
                                ->where('schoolname', $this->schoolname)
                                ->get('number')
                                ->last();
        
        if($prev_number == null){
            $this->prev_number1 = 0;
        }else {
            $prev_number = Contents::where('hex_address', $this->hex_address)
                                ->where('schoolname', $this->schoolname)
                                ->get('number')
                                ->last();
            $this->prev_number1 = $prev_number['number'];
        }

        
        

    
  
     }

    public function render()
    {
        return view('livewire.number-list', ['schools' => $this->schools,
        'prev_number1' => $this->prev_number1,]);
    }
 
    public function store()

    {
        
        $prev_number = Contents::where('hex_address', $this->hex_address)
                                ->where('schoolname', $this->schoolname)
                                ->get('number')
                                ->last();

        $this->next_year = Contents::where('hex_address', $this->hex_address)
                                    ->where('schoolname', $this->schoolname)
                                    ->get('created_ats')
                                    ->last();
        $this->next_year = $this->next_year['created_ats'];
        
        if($this->next_year != Carbon::now()->format('Y')){
            if($prev_number == null){
            $this->prev_number1 = 0;
              }else {
                  $prev_number = Contents::where('hex_address', $this->hex_address)
                                      ->where('schoolname', $this->schoolname)
                                      ->get('number')
                                      ->last();
                  $this->prev_number1 = $prev_number['number'];
        }
        }


        
        // if($this->next_year != Carbon::now()->format('Y')){
        //     $prev_number['number'] = 0;
        // }

      

        
        Contents::create([
            'number' => $this->prev_number1+1,
            'schoolname' => $this->schoolname,
            'hex_address' => $this->hex_address,
            'content' => $this->content,
            'created_ats' => $this->created_ats->format('Y'),
        ]);

        
        session()->flash('success', '가정통시문 제목이 성공적으로 등록되었습니다.');

        return $this->redirect('/list?schoolname='.$this->schoolname.'&code='.$this->hex_address, navigate: true);

    }

    public function number_save()
    {
  
        Contents::create([
          'number' => $this->numbers,
          'schoolname' => $this->schoolname,
          'hex_address' => $this->hex_address,
          'content' => $this->content,
          'created_ats' => $this->created_ats->format('Y-m-d'),
    ]);
      
          session()->flash('success', '가정통시문 제목이 성공적으로 등록되었습니다.');
  
    return $this->redirect('/list?schoolname='.$this->schoolname.'&code='.$this->hex_address, navigate: true);

    }
}
