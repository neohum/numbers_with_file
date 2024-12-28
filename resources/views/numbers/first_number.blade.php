<x-app>
<div>
  <div class="navbar bg-base-100">
    <div class="flex-1">
      <br>
      <br>
      <div class="text-xl hero">
        <h1>{{ $schoolname }} 가정통신문 채번 서비스</h1>
      </div>
    </div>

    <div class="flex-none">

    </div>

  </div>

  <div class=hero>
    <div class="shadow-xl card bg-base-100 w-100">

      <div class="card-head w-100">

        
        <form action="{{ route('first_number_save') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h6>시작 번호와 내용을 입력해주세요. 시작 번호는 수정할 수 없지만 내용은 수정 가능합니다. </h6>
          <h6>1부터 시작하시려면 시작 번호에 1번을 넣어 입력 후 다음 페이지에서 수정을 하세요</h6>
          <table class="table">
            <tr>
              <td class="mt-5">
                <label for="content">
                  <h6>가정통신문 시작 번호</h6>

                </label>
              </td>
              <td class="mt-5">
                <input type="number" name="number" placeholder="여기를 클릭" class="w-full max-w-7lx input" autofocus
                  required />
              </td>
              <input hidden type="text" name="schoolname" value="{{ $schoolname }}" />
              <input hidden type="text" name="schoolcode" value="{{ $schoolcode }}" />
              <td class="mt-5">
                <label for="content">
                  <h6>가정통신문 제목</h6>
                </label>
              </td>
            
              <td class="mt-5">
                <input type="text" name="content" placeholder="여기를 클릭" class="w-full max-w-7lx input" autofocus
                  required />
              </td>
              
              <td class="mt-5">
                <label for="fileUpload">
                  <input type="file" class="w-full max-w-xs file-input" name="file">
                </label>
              </td>
              <td class="mt-5">
                <button type="submit" class="mx-5 btn btn-primary">저장하기</button>
              </td>
            </tr>
          </table>

        </form>
       
        

      </div>
</x-app>