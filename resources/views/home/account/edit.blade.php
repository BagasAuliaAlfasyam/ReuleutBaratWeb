@extends('home.template.main')
@section('content')
    <main id="main" class="main">
      <section class="pagetitle">
        <h1>Akun</h1>

        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/accounts">User</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </section>

      <div class="card">

        <div class="card-body pt-4">
          <a href="{{ url('/accounts') }}" role="button" class="btn btn-secondary mb-2">
            <i class="bi bi-arrow-left-circle"></i> Back
          </a><hr>
          
          {{-- Form --}}
          <!-- Custom Styled Validation -->
          <form class="row g-3 needs-validation {{ $errors->any() ? 'was-validated' : '' }}"
              action="{{ url('/account/'.$user->id.'/update') }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="col-12">
              <label for="fullname" class="form-label">Fullname</label>
              <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" value="{{ $user->fullname }}">

              @error('fullname')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ $user->username }}">

              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-12">
              <label for="email" class="form-label">E-Mail</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}">

              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            
            <div class="col-12">
              <label for="phone" class="form-label">Phone</label>
              <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $user->phone }}">

              @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            
            <div class="col-12">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea name="address" id="alamat" cols="30" class="form-control @error('address') is-invalid @enderror">{{ $user->address }}</textarea>

              @error('address')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-12">
                <label for="images" class="form-label">Images</label>
                <input type="hidden" name="old_img" value="{{ $user->user_images }}">
                <input type="file" class="form-control @error('user_images') is-invalid @enderror"
                    id="images" name="user_images">
                @error('user_images')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>

            <div class="col-12">
              <label for="role" class="form-label">Role</label>
              <select name="role" id="role" class="form-select">
                <option value="0" {{ ($user->role == 0) ? 'selected' : '' }}>User</option>
                <option value="1" {{ ($user->role == 1) ? 'selected' : '' }}>Admin</option>
              </select>
            </div>

            <a href="/account/{{ $user->username }}/change-password"><small>Change Password</small></a>
            
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form><!-- End Custom Styled Validation -->
          {{-- End Form --}}
        </div>
      </div>
    </main>
@endsection
