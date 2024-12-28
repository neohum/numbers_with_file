<x-app>
<div>
  <div class="navbar bg-base-100">
    <div class="flex-1">
      <br>
      <br>
      <div class="text-xl hero">
        <h2>{{ $schoolname }} 가정통신문 채번 서비스</h2>
      </div>
    </div>

    <div class="flex-none">

    </div>

  </div>

  <div class=hero>
    <div class="shadow-xl card bg-base-100 w-100">

      <div class="card-head w-100">

        
        <form action="{{ route('content_save') }}" method="POST" enctype="multipart/form-data">
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
                  <input type="text" name="content" placeholder="여기를 클릭" class="w-full max-w-7lx input" autofocus
                    required />
                </td>
                <input hidden  type="text" name="schoolname" value="{{ $schoolname }}" />
                <input hidden type="text" name="schoolcode" value="{{ $schoolcode }}" />
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
          </div>
        </form>
        <div>
          <div>
            <div class="card-body">
              <div class="mt-5 form-group">
                <table class="table table-stripe">

                  <thead>
                    
                    <tr>
                      <th>입력일</th>
                      <th>번호</th>
                      <th>가정통신문 제목</th>
                      <th>파일</th>
                      <th class="mt-5">수정</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($schools as $school)
                    <tr>
                      <td>{{ $school->created_at }}</td>
                      <td>{{ $school->created_ats }}년 - {{ $school->number }}번</td>
                      <td>{{ $school->content }}</td>
                      <td>
                        @if ($school->file)
                        <a href="{{ asset('storage/' . $school->file) }}" download>다운로드</a>
                        @endif
                      </td>
                      <td class="mt-5">
                       
                        <a href="{{ route('edit', $school->id) }}" class="btn btn-primary">수정하기</a>
                        
                      </td>
                    </tr>
                    
                    @endforeach

                  </tbody>
                </table>
                {{ $schools->links() }}
              </div>
           
            </div>
          </div>
          {{-- @foreach ($numbers as $number) --}}


        </div>

      </div>
      <script>
      $('#file').bind('change', function() {
        let filesize = this.files[0].size // On older browsers this can return NULL.
        let filesizeMB = (filesize / (1024*1024)).toFixed(2);

        if(filesizeMB <= 10) {
            return 0;// Allow the form to be submitted here.
        } else {
            alert('파일 크기는 10MB 이하여야 합니다.');
            return 1;// Prevent the form from being submitted.
        }
      });
      </script>
    </div>
  </div>
</div>

</x-app>