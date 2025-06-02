<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Fetcher</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <h1>Data Fetcher</h1>
    <form method="GET" action="/">
        <label for="source">Select Data Source:</label>
        <select name="source" id="source">
            <?php foreach ($sources as $key => $name): ?>
                <option value="<?php echo htmlspecialchars($key); ?>" <?php echo $source === $key ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="fetch">Fetch Data</button>
    </form>

    <div class="results">
        <?php if (!empty($results['data'])): ?>
            <h2>Results</h2>
            <ul>
                <?php foreach ($results['data'] as $item): ?>
                    <li>
                        <?php
                        echo htmlspecialchars($source === 'news' ? ($item['title'] ?? 'No title') : ($item['weather'][0]['description'] ?? 'No description'));
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if ($results['total_pages'] > 1): ?>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $results['total_pages']; $i++): ?>
                        <a href="/?source=<?php echo $source; ?>&page=<?php echo $i; ?>&fetch=1" class="<?php echo $page === $i ? 'active' : ''; ?>">
                            <?php echo $i; ?>
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