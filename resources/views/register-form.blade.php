@extends('layout.login-no-indexes')
@section('style')
    <style>
    </style>
@endsection
@section('content')
    <section class="formlogin" style="padding:10%">
        <img src="{{ asset('asset-image/laptopthingy.png') }}" alt=""
            style="position: absolute; top:350px;left:50px;z-index: 1;">
        <div class="container-fluid" style="border: 0; border-radius:20px;">
            <div class="row" style="border-radius: 20px">
                <div class="col-4" style="background-color: #1DC08B;padding:2%;">
                    <h1 style="font-family: 'Coolvetica', sans-serif;color:white;font-weight:400;">Only in RPL can you find
                        <br> impeccably safe and <br> organized borrowed items
                    </h1>
                </div>
                <div class="col-8" style="border: 0;background:white;padding:5%">
                    <div class="row">
                        <div class="col-10">
                            <h5>Register</h5>
                        </div>
                        <div class="col-2">
                            <img src="{{ asset('asset-image/logo.png') }}" width="64" height="64" alt="">
                        </div>
                    </div>
                    <form action="{{ route('register') }}" class="mt-5" method="post">
                        @csrf
                        <label for="username"
                            style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.736); background: #F0F2F5; line-height: normal; border-radius: 10px"
                            placeholder="Username">
                        <label for="password" class="mt-2"
                            style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Password</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" 
                            style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.736); background: #F0F2F5; line-height: normal; border-radius: 10px"
                            placeholder="Password">
                        <label for="role"
                            style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Role</label>
                        <select class="js-example-basic-single mb-5" tyle="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.736); background: #F0F2F5; line-height: normal; border-radius: 10px"
                            style="padding:15px;width: 100%; border: 1px solid rgba(255, 255, 255, 0.636);background:#F0F2F5;line-height:normal;border-radius:10px"
                            id="role" name="role">
                            <option value="" selected disabled>Pilih Role (USER)</option>
                            @foreach ($role as $key => $item)
                                <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                                    {{ $item }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit"
                            style="background-color: #13B07E; width: 100%; height:5vh; border: none;">Register</button>
                        <center><span class="small-thing"
                                style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Already have
                                an account? <a href="{{ route('datapinjam.login') }}">Login</a></span></center>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
