<!DOCTYPE html>
<html>
<head>
  <title>Login - ClearView</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container">
      <h1 class="title">ClearView: Insights at a Glance</h1>
      <h2>Login</h2>

      @if($errors->any())
          <div class="alert alert-error">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <label>Email:</label>
          <input type="email" name="email" required>

          <label>Password:</label>
          <input type="password" name="password" required>

          <button type="submit">Login</button>
      </form>

      <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
      <div class="footer-thought">📘 “Learning never exhausts the mind.” – Leonardo da Vinci</div>
  </div>
</body>

</html>
