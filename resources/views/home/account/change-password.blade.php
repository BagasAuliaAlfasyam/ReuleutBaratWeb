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
              action="{{ url('/account/'.$user->id.'/update-password') }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            
            <div class="col-12">
              <label for="old-password" class="form-label">Current Password</label>
              <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="old-password">

              @error('current_password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-12">
              <label for="password" class="form-label">New Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">

              @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="col-12">
              <label for="conf-password" class="form-label">Confirmation Password</label>
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="conf-password">

              @error('password_confirmation')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            
            <div class="col-12">
              <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form><!-- End Custom Styled Validation -->
          {{-- End Form --}}
        </div>
      </div>
    </main>
@endsection
