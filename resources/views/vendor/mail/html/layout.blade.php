<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
  <div class="container" style="max-width: 600px !important">
    {{ $header  }}
    {{ $body    or '' }}
    {{ $action  or '' }}
    {{ $subcopy or '' }}
    {{ $footer  }}
  </div>
</body>

</html>
