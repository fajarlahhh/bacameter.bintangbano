<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Habit</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  @livewireStyles
</head>
@php
  $bodyClass = !empty($boxedLayout) ? 'boxed-layout ' : '';
  $bodyClass .= !empty($paceTop) ? 'pace-top ' : '';
  $bodyClass .= !empty($bodyExtraClass) ? $bodyExtraClass . ' ' : '';
@endphp

<body class="hold-transition login-page">

  @livewire('auth.login')

  @livewireScripts

  <script src="/plugins/jquery/jquery.min.js"></script>
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/dist/js/adminlte.min.js"></script>

  @stack('scripts')
</body>

</html>
