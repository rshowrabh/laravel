@include('inc.header')


<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Select Your Contribution</p>

<form method="POST" action="{{ route('select.role') }}">
                        @csrf

     <div class="input-group mb-3">
          <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="Enter Phone No">

                                
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
       
        <div class="input-group mb-3">
            

            <select id="role_id" type="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id">
                <option selected value="">Select User Type</option>
                <option value="2">Tutor</option>
                <option value="3">Student</option>
            </select>

                                
                            
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-tasks"></span>
            </div>
          </div>
          @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
        
</form>


    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@include('inc.footer')
