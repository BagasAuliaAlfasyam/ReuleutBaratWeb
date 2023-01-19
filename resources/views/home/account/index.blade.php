@extends('home.template.main')
@section('content')
    <main id="main" class="main">
      <section class="pagetitle">
        <h1>Akun</h1>

        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </section>

      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Postingan Berita</h5>
          <a href="{{ url('/blog/post/create') }}" role="button" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Postingan
          </a>
        </div>

        <div class="card-body mt-2">
          <div class="table-responsive">
            <table class="table table-borderless datatable text-center">
              <thead>
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Fullname</th>
                  <th class="text-center" scope="col">Username</th>
                  <th class="text-center" scope="col">E-Mail</th>
                  <th class="text-center" scope="col">Phone</th>
                  <th class="text-center" scope="col">Address</th>
                  <th class="text-center" scope="col">Aksi</th>
                </tr>
              </thead>
              
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone}}</td>
                    <td>{{ $user->address}}</td>
                    <td>
                      <div class="btn-group btn-group-sm" role="group"
                          aria-label="Basic example">
                        <form action="{{-- url('/blog/post/show').'/'.$item->id --}}"
                            method="GET">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-eye"></i>
                            </button>
                        </form>

                        <form action="{{-- url('/blog/post/edit').'/'.$item->id --}}"
                            method="GET">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </form>
                        
                        <form action="{{-- url('/blog/post/destroy').'/'.$item->id --}}"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="alert('Yakin untuk menghapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
@endsection
