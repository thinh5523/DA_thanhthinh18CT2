<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login and Register</title>
      <link rel="stylesheet" href="{{asset('fontend/css/login.css')}}">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="wrapper">
         <div class="title-text">
            <div class="title login">
               Đăng nhập
            </div>
            <div class="title signup">
               Đăng kí
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Đăng nhập</label>
               <label for="signup" class="slide signup">Đăng kí</label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
               <form action="{{URL::to('/login-customer')}}" method="POST" class="login">
                  {{ csrf_field() }}
                  <div class="field">
                     <input type="text" name="email_account" placeholder="Địa chỉ Email" required>
                  </div>
                  <div class="field">
                     <input type="password" name="password_account" placeholder="Mật khẩu" required>
                  </div>
                  <div class="pass-link">
                     <a href="">Quên mật khẩu?</a>
                     <span style="margin-left: 50px;"><input type="checkbox" name=""> Lưu đăng nhập</span>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Đăng nhập">
                  </div>
                  <div class="signup-link">
                     Chưa có tài khoản? <a href="">Đăng kí mới</a>
                  </div>
               </form>
               <form action="{{URL::to('/add-customer')}}" method="POST" class="signup">
                  {{ csrf_field() }}
                  <div class="field">
                     <input type="text" name="customers_name" placeholder="Họ và tên" required>
                  </div>
                  <div class="field">
                     <input type="email" name="customers_email" placeholder="Địa chỉ Email" required>
                  </div>
                  <div class="field">
                     <input type="password" name="customers_password" placeholder="Mật khẩu" required>
                  </div>
                  <div class="field">
                     <input type="text" name="customers_phone" placeholder="Phone" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" value="Đăng kí">
                  </div>
               </form>
            </div>
         </div>
      </div>
      <script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });
      </script>
   </body>
</html>
