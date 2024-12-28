<x-app>
  <div>
    <div class="navbar bg-base-100">
      <div class="flex-1">
        <br>
        <br>
        <div class="text-xl hero">
          <h2>수정 화면</h2>
        </div>
      </div>

      <div class="flex-none">

      </div>

    </div>

    <div class=hero>
      <div class="shadow-xl card bg-base-100 w-100">

        <div class="card-head w-100">


          <form action="{{ route('content_update', $school->id) }}" method="POST">
            @csrf
            @if ($errors->any())


            @endif
            <div class="form-group mt-50">

              <br>
              <table class="table">
                <tr>
                  <td class="mt-5">
                    <label for="content">
                      <h6>가정통신문 제목</h6>
                    </label>

                  </td>
                  <td class="mt-5">
                    <input type="text" name="content" value="{{ $school->content }}"  class="w-full max-w-7lx input" autofocus
                      required />
                  </td>
                  <input hidden  type="text" name="schoolname" value="{{ $school->schoolname }}" />
                  <input hidden type="text" name="schoolcode" value="{{ $school->schoolcode }}" />

                  <td class="mt-5">
                    <button type="submit" class="mx-5 btn btn-primary">수정하기</button>
                  </td>
                  <td class="mt-5">
                    
                    <form action="{{ route('numbers.list') }}" method="GET">
                      <input hidden type="text" name="schoolname" value="{{ $school->schoolname }}" />
                      <input hidden type="text" name="schoolcode" value="{{ $school->schoolcode }}" />
                      <input hidden type="text" name="created_ats" value="{{ $school->created_ats }}" />
                      <button type="submit" class="mx-5 btn btn-danger">취소하기</button>
                    </form>
                </tr>
              </table>
            </div>
          </form>
      

        </div>
</x-app>