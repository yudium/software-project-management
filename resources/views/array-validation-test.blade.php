<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form method="post" action="{{ route('array-validation-test') }}">
        @csrf

        <input type="text" name="user_name[]">
        <input type="text" name="user_name[]">

        <input type="text" name="email[]">
        <input type="text" name="email[]">

        <button>Save</button>
    </form>
</body>
</html>
