<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>refresh</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

</head>

<body>
</body>
<script>
    localStorage.removeItem("userLoggedIn");
</script>
<script>
    localStorage.setItem("userLoggedIn", "true");
    window.location.href = '/';
</script>

</html>