document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('fetch-form');
    const results = document.getElementById('results');

    form.addEventListener('submit', event => {
        event.preventDefault();
        loadData(1);
    });

    // Load data and render results with pagination
    async function loadData(page) {
        const source = document.getElementById('source').value;

        results.textContent = 'Loading...';

        try {
            const response = await fetch(`./?source=${encodeURIComponent(source)}&page=${page}`);

            if (!response.ok) {
                throw new Error(`Server error: ${response.status}`);
            }

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Invalid response format');
            }

            const data = await response.json();

            if (data.error) {
                results.textContent = 'Error: ' + data.error;
                return;
            }

            renderResults(data, page);
        } catch (error) {
            results.textContent = 'Fetch error: ' + error.message;
        }
    }

    // Render results and pagination buttons
    function renderResults(data, currentPage) {
        if (!data.data || data.data.length === 0) {
            results.textContent = 'No data found.';
            return;
        }

        const list = document.createElement('ul');
        data.data.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = `<strong>${item.title}</strong>: ${item.description}${item.temp ? ', Temp: ' + item.temp : ''}`;
            list.appendChild(li);
        });

        results.innerHTML = '';
        results.appendChild(list);

        // Pagination controls
        if (data.total_pages > 1) {
            const pagination = document.createElement('div');
            pagination.classList.add('pagination');

            if (currentPage > 1) {
                const prevBtn = document.createElement('button');
                prevBtn.textContent = 'Prev';
                prevBtn.onclick = () => loadData(currentPage - 1);
                pagination.appendChild(prevBtn);
            }

            pagination.appendChild(document.createTextNode(` Page ${currentPage} of ${data.total_pages} `));

            if (currentPage < data.total_pages) {
                const nextBtn = document.createElement('button');
                nextBtn.textContent = 'Next';
                nextBtn.onclick = () => loadData(currentPage + 1);
                pagination.appendChild(nextBtn);
            }

            results.appendChild(pagination);
        }
    }
});

