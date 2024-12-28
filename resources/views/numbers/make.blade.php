<x-app>
  <div class="min-h-screen hero bg-base-200">
    <div class="text-center hero-content">
      <div class="max-w-md">
        <h1 class="text-5xl font-bold">학교명 입력하기</h1>
        <p class="py-6">
          학교명을 입력하신 후, 서비스 생성하기 버튼을 눌러주세요.
        </p>
        <p class="py-6">
          서비스를 생성 후 주소창의 해당 주소를 기록해두세요.
        </p>
        <form action="{{ route('save') }}" method="POST">
          @csrf
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
  
          @endif
          <div class="form-group mt-50">
            <label for="school_name">
              <h6>학교명</h6>
            </label>
            <br>
            <input type="text" id="schoolname" name="schoolname" placeholder="학교명" class="w-full max-w-xs input" autofocus
              required />
            <br>
            <button type="submit" class="mt-3 btn btn-primary">서비스 생성하기</button>
          </div>
        </form>
  
      </div>
    </div>
  </div>
</x-app>