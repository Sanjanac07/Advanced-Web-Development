<!DOCTYPE html>
<html>
<head>
  <title>Register - ClearView</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container">
      <h1 class="title">ClearView: Insights at a Glance</h1>
      <h2>Register</h2>

      @if($errors->any())
          <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('register.post') }}">
          @csrf
          <label>Name</label>
          <input type="text" name="name" placeholder="Enter your full name" required>

          <label>Email</label>
          <input type="email" name="email" placeholder="Enter your email" required>

          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>

          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" placeholder="Confirm your password" required>

          <label>Role</label>
          <select name="role" required>
              <option value="student">Student</option>
              <option value="staff">Staff</option>
          </select>

          <button type="submit">Register</button>
      </form>

      <p>Already registered? <a href="{{ route('login') }}">Login here</a></p>
      <div class="footer-thought">📘 “Education is the most powerful weapon which you can use to change the world.” – Nelson Mandela</div>
  </div>
</body>
</html>
