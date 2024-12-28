<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contents;
use Illuminate\Http\Request;


class EditNumber extends Component
{
  public $id, $content;
  public $schoolname, $hex_address;
    public function render()
    {
        return view('livewire.edit-number');
    }

    public function mount(Contents $id, Request $request){
        $this->id = $id;
        $this->content = $id->content;
        $this->schoolname = $request->schoolname;
        $this->hex_address = $request->code;
    }

    public function edit()
    {
        $validated = $this->validate([
            'content' => 'required',
        ]);

        $this->id->update($validated);
        session()->flash('success', '가정통신문 제목의 내용이 수정되었습니다.');

        return $this->redirect('/list?schoolname='. $this->schoolname .'&code='.$this->hex_address, navigate:true);
    }
}
