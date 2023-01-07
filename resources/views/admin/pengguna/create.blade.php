<!-- Create Modal -->
<div class="modal fade" id="createPengguna" tabindex="-1" role="dialog" aria-labelledby="createPenggunaLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPenggunaLabel">Tambahkan Pengguna</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pengguna.store') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Roles</label>
                        <select class="form-control " name="role" required>
                            <option value="{{ $roles[1] }}">User</option>
                            <option value="{{ $roles[0] }}">Admin</option>
                        </select>
                    </div>
                    @include('admin.components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
