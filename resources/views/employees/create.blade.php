<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form action="{{ route('merchant.create.employees') }}" class="form mt-5" method="post">
                @csrf
                <h3 class="text-center text-dark">Register</h3>
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Tên hiển thị</label><br>
                    <input type="text" name="name" id="email" class="form-control">
                </div>
                @error('name')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Tên đăng nhập</label><br>
                    <input type="text" name="username" id="email" class="form-control">
                </div>
                @error('username')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                @error('email')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group mt-3">
                    <label for="password" class="text-dark">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @error('password')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <div class="form-group mt-3">
                    <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                    <input type="password" name="password_confirm" id="confirm-password" class="form-control">
                </div>
                @error('password_confirm')
                <div style="color:red;">{{ $message }}</div><br>
                @enderror
                <input type="hidden" name="role_id" value="3">
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
</div>