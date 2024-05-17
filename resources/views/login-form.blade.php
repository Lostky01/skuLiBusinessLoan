@extends('layout.login-no-indexes')
@section('style')
    <style>
    </style>
@endsection
@section('content')
    <section class="formlogin" style="padding:10%;">
        <img src="{{ asset('asset-image/laptopthingy.png') }}" alt="" style="position: absolute; top:350px;left:150px;z-index: 1;">
        <div class="container" style="border: 0; border-radius:20px;">
            <div class="row" style="border-radius: 20px">
                <div class="col-6" style="background-color: #1DC08B;padding:2%;">
                  <h1 style="font-family: 'Helvetica Neue', sans-serif; color:white;font-weight:500; font-size:35px">Only in RPL you can find <br> impeccably safe and <br> organized borrowed items</h1>
                  
                </div>
                <div class="col-5" style="border: 0;background:white;padding:5%">
                    <div class="row">
                        <div class="col-10">
                            <h5>Log in</h5>
                        </div>
                        <div class="col-2">
                            <img src="{{ asset('asset-image/logo.png') }}" width="64" height="64" alt="">
                        </div>
                    </div>
                    <form action="{{ route('user-auth') }}" class="mt-5" method="post">
                      @csrf
                        <label for="username"
                            style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.736); background: #F0F2F5; line-height: normal; border-radius: 10px"
                            placeholder="">
                        <label for="password" class="mt-2"
                            style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Password</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" class="mb-5"
                            style="padding: 15px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.736); background: #F0F2F5; line-height: normal; border-radius: 10px"
                            placeholder="">
                          <button class="btn btn-primary" type="submit"
                            style="background-color: #13B07E; width: 100%; height:5vh; border: none;">Login</button>
                            <center><span class="small-thing" style="font-family: 'General Sans', sans-serif; font-size:14px; color:#656565;">Don't have account yet? <a href="{{ route('datapinjam.register') }}">register</a></span></center>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
