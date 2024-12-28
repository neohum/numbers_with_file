<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Schoolname;
use Illuminate\Http\Request;


class SignUp extends Component
{
  public  $schoolname, $hex_address;


    public function render()
    {
        return view('livewire.sign-up', [$this->schoolname, $this->hex_address]);
    }
    private function resetInputFields(){

        $this->schoolname = '';

        $this->hex_address = '';

    }

    public function store()

    {
        $validatedDate = $this->validate([
            'schoolname' => 'required',
        ]);
        $this->schoolname = $validatedDate['schoolname'];

        $hex = 'l' . bin2hex(random_bytes(20));
       
        try{
            $hexs = Schoolname::where('hex_address', $hex)->firstOrFail();

        } catch (\Exception $e) {
            $rent = null;
        }
        Schoolname::create([
            'schoolname' => $this->schoolname,
            'hex_address' => $hex,
        ]);

        
        

        $this->redirect('/list?schoolname='. $this->schoolname .'&code='.$hex, navigate: true);

    }


}
