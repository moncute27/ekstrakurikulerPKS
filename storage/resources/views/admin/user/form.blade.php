@extends('layouts.admin')

@section('title', $item->exists ? 'Edit User' : 'Tambah User')
@section('subtitle', 'Akun pengakses panel admin')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $item->exists ? 'Edit User' : 'Tambah User' }}</h1>
            <p>Peran <strong>admin</strong> dan <strong>pengurus</strong> dapat masuk ke panel admin.</p>
        </div>

        <a href="{{ route('admin.user.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.user.update', $item) : route('admin.user.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('name') has-error @enderror">
                        <label for="name">Nama <span class="req">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}" required>
                        @error('name')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('email') has-error @enderror">
                        <label for="email">Email <span class="req">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $item->email) }}" required>
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('role') has-error @enderror">
                        <label for="role">Peran <span class="req">*</span></label>
                        <select id="role" name="role" required>
                            @foreach(\App\Models\User::ROLES as $role)
                                <option value="{{ $role }}" @selected(old('role', $item->role) === $role)>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach
                        </select>
                        <span class="hint">Peran "user" tidak dapat masuk ke panel admin.</span>
                        @error('role')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('foto') has-error @enderror">
                        <label for="foto">Foto Profil</label>
                        <input type="file" id="foto" name="foto" accept="image/*" data-preview="#previewFoto">
                        <div class="preview">
                            <img id="previewFoto" src="{{ $item->foto ? asset($item->foto) : '' }}"
                                 alt="" style="{{ $item->foto ? '' : 'display:none;' }}">
                        </div>
                        @error('foto')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('password') has-error @enderror">
                        <label for="password">
                            Password @if(! $item->exists)<span class="req">*</span>@endif
                        </label>
                        <input type="password" id="password" name="password" @if(! $item->exists) required @endif>
                        <span class="hint">
                            Minimal 8 karakter.{{ $item->exists ? ' Kosongkan bila tidak ingin mengganti.' : '' }}
                        </span>
                        @error('password')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Ulangi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               @if(! $item->exists) required @endif>
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.user.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Simpan User' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
