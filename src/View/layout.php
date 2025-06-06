<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Fetcher</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Data Fetcher</h1>

    <form id="fetch-form">
        <label for="source">Choose data source:</label>
        <select id="source" name="source" required>
            <option value="news">News API</option>
            <option value="weather">Weather API</option>
        </select>
        <button type="submit">Fetch</button>
    </form>

    <div id="results" aria-live="polite"></div>
</div>
<script src="js/main.js"></script>

</body>
</html>
