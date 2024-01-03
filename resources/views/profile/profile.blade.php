@extends('template.main')
@section('title', 'Edit Profile')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <!-- ... (unchanged) ... -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('profile.update', $user->id_user) }}" method="POST"
                                    id="editProfileForm">
                                    @csrf
                                    @method('PUT')

                                    <!-- Add your form fields here -->
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password:</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="********" minlength="8">
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="updateProfileBtn"
                                        disabled>Update Profile</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add JavaScript to enable/disable the "Update Profile" button based on form changes
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('editProfileForm');
            const updateProfileBtn = document.getElementById('updateProfileBtn');

            const formInputs = form.querySelectorAll('input, select, textarea');

            formInputs.forEach(input => {
                input.addEventListener('input', () => {
                    updateProfileBtn.disabled = false;
                });
            });
        });
    </script>
@endsection
