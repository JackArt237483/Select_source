<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Fetcher</title>
    <link rel="stylesheet" href="../../public/style.css">
    <link rel="stylesheet" href="/project/select/Select_source/public/style.css">
    <style>
        .container { max-width: 800px; margin: 0 auto; font-family: sans-serif; }
        .pagination a { margin: 0 5px; text-decoration: none; }
        .pagination .active { font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Fetcher</h1>
    <form id="fetch-form">
        <label for="source">Choose data source:</label>
        <select id="source">
            <option value="news">News API</option>
            <option value="weather">Weather API</option>
        </select>
        <button type="submit">Fetch</button>
    </form>
    <div id="results"></div>
</div>

<script>
    const form = document.getElementById('fetch-form');
    const results = document.getElementById('results');

    form.addEventListener('submit', e => {
        e.preventDefault();
        loadData(1);
    });

    async function loadData(page) {
        const source = document.getElementById('source').value;
        results.innerHTML = 'Loading...';

   const res = await fetch(`/?source=${source}&page=${page}`);
    const contentType = res.headers.get("content-type");
        if (data.error) {
            results.innerHTML = `<p class="error">${data.error}</p>`;
            return;
        }

        const items = data.data.map(item => `
            <li>
                <strong>${item.title}</strong><br>
                ${item.description}<br>
                ${item.url ? `<a href="${item.url}" target="_blank">Read more</a>` : item.temp || ''}
            </li>
        `).join('');

        let pagination = '';
        for (let i = 1; i <= data.total_pages; i++) {
            pagination += `<a href="#" onclick="loadData(${i})" class="${i === page ? 'active' : ''}">${i}</a>`;
        }

        results.innerHTML = `<ul>${items}</ul><div class="pagination">${pagination}</div>`;
    }
</script>
</body>
</html>
