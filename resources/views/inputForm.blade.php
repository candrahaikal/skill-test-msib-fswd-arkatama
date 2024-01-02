<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkatama</title>
</head>
<body>
    <h2>Input Form</h2>

    <form action="/store" method="post">
        @csrf
        <label for="data">Masukkan data (Ex: Candra 58THN Jakarta ): </label>
        <input type="text" name="data" required>
        <button type="submit">Submit</button>
    </form>


</body>
</html>
