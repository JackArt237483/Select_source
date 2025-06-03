<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Fetcher</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
<div class="container">
    <h1>Data Fetcher</h1>
    <form method="GET" action="">
        <label for="source">Select Data Source:</label>
        <select name="source" id="source">
            <?php foreach ($sources as $key => $name): ?>
                <option value="<?= htmlspecialchars($key) ?>" <?= $source === $key ? 'selected' : '' ?>>
                    <?= htmlspecialchars($name) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="fetch" value="1">
        <button type="submit">Fetch Data</button>
    </form>

    <div class="results">
        <?php if (!empty($results['renderItems'])): ?>
            <h2>Results</h2>
            <ul>
                <?php foreach ($results['renderItems'] as $text): ?>
                    <li><?= htmlspecialchars($text) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($results['total_pages'] > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $results['total_pages']; $i++): ?>
                        <a href="/?source=<?= urlencode($source) ?>&page=<?= $i ?>&fetch=1"
                           class="<?= $page === $i ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php elseif (isset($_GET['fetch'])): ?>
            <p>No data available or an error occurred.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
