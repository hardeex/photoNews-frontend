
<section class="bg-purple-700 text-white p-4 md:p-8 rounded-lg mb-8">
    <h1 class="text-2xl md:text-3xl font-bold mb-4">EXPLORE THE WORLD WITH US</h1>
    <form id="search-form" class="flex">
        <input type="text" name="query" placeholder="Search news, birthday, obituary..." class="flex-grow p-2 rounded-l-lg text-black" required>
        <button type="submit" class="bg-pink-500 p-2 rounded-r-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </form>
    <!-- Container for search results -->
    <div id="search-results" class="mt-4"></div>
</section>

<script>
    // Pass API base URL from Laravel config to JavaScript
    const apiBaseUrl = '<?php echo config('api.base_url'); ?>';

    document.getElementById('search-form').addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent default form submission

        const query = this.querySelector('input[name="query"]').value.trim();
        const resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = '<p class="text-white">Loading...</p>';

        try {
            const response = await fetch(`${apiBaseUrl}/search?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error(`Search request failed with status ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();

            if (data.status === 'success' && data.data.length > 0) {
                resultsContainer.innerHTML = '';
                data.data.forEach(item => {
                    const resultDiv = document.createElement('div');
                    resultDiv.className = 'bg-white text-black p-4 rounded-lg mb-4';
                    resultDiv.innerHTML = `
                        <h3 class="text-xl font-bold">${item.title}</h3>
                        <p class="text-sm text-gray-600">Type: ${item.type.charAt(0).toUpperCase() + item.type.slice(1)}</p>
                        <p>${item.excerpt}</p>
                        ${item.featured_image ? `<img src="${item.featured_image}" alt="${item.title}" class="w-full h-48 object-cover rounded mt-2">` : ''}
                        <p class="text-sm text-gray-600">Posted on: ${new Date(item.created_at).toLocaleDateString()}</p>
                        ${item.creator ? `<p class="text-sm text-gray-600">By: ${item.creator.name}</p>` : ''}
                        ${renderSpecificFields(item)}
                        <a href="/${item.type}/${item.slug}" class="text-blue-500 hover:underline">Read more</a>
                    `;
                    resultsContainer.appendChild(resultDiv);
                });

                const pagination = data.pagination;
                const paginationDiv = document.createElement('div');
                paginationDiv.className = 'flex justify-between mt-4';
                paginationDiv.innerHTML = `
                    ${pagination.prev_page_url ? `<a href="${pagination.prev_page_url}" class="text-white hover:underline">Previous</a>` : '<span></span>'}
                    <span class="text-white">Page ${pagination.current_page} of ${pagination.last_page}</span>
                    ${pagination.next_page_url ? `<a href="${pagination.next_page_url}" class="text-white hover:underline">Next</a>` : '<span></span>'}
                `;
                resultsContainer.appendChild(paginationDiv);
            } else {
                resultsContainer.innerHTML = '<p class="text-white">No results found.</p>';
            }
        } catch (error) {
            console.error('Search error:', error.message);
            resultsContainer.innerHTML = `<p class="text-red-300">Error: ${error.message}. Please try again later.</p>`;
        }
    });

    document.addEventListener('click', async function (event) {
        if (event.target.tagName === 'A' && event.target.href.includes('/search')) {
            event.preventDefault();
            const resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = '<p class="text-white">Loading...</p>';

            try {
                const response = await fetch(event.target.href, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error(`Pagination request failed with status ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                resultsContainer.innerHTML = '';
                data.data.forEach(item => {
                    const resultDiv = document.createElement('div');
                    resultDiv.className = 'bg-white text-black p-4 rounded-lg mb-4';
                    resultDiv.innerHTML = `
                        <h3 class="text-xl font-bold">${item.title}</h3>
                        <p class="text-sm text-gray-600">Type: ${item.type.charAt(0).toUpperCase() + item.type.slice(1)}</p>
                        <p>${item.excerpt}</p>
                        ${item.featured_image ? `<img src="${item.featured_image}" alt="${item.title}" class="w-full h-48 object-cover rounded mt-2">` : ''}
                        <p class="text-sm text-gray-600">Posted on: ${new Date(item.created_at).toLocaleDateString()}</p>
                        ${item.creator ? `<p class="text-sm text-gray-600">By: ${item.creator.name}</p>` : ''}
                        ${renderSpecificFields(item)}
                        <a href="/${item.type}/${item.slug}" class="text-blue-500 hover:underline">Read more</a>
                    `;
                    resultsContainer.appendChild(resultDiv);
                });

                const pagination = data.pagination;
                const paginationDiv = document.createElement('div');
                paginationDiv.className = 'flex justify-between mt-4';
                paginationDiv.innerHTML = `
                    ${pagination.prev_page_url ? `<a href="${pagination.prev_page_url}" class="text-white hover:underline">Previous</a>` : '<span></span>'}
                    <span class="text-white">Page ${pagination.current_page} of ${pagination.last_page}</span>
                    ${pagination.next_page_url ? `<a href="${pagination.next_page_url}" class="text-white hover:underline">Next</a>` : '<span></span>'}
                `;
                resultsContainer.appendChild(paginationDiv);
            } catch (error) {
                console.error('Pagination error:', error.message);
                resultsContainer.innerHTML = `<p class="text-red-300">Error: ${error.message}. Please try again later.</p>`;
            }
        }
    });

    function renderSpecificFields(item) {
        switch (item.type) {
            case 'birthday':
                return `
                    <p class="text-sm">Celebrant Age: ${item.celebrant_age || 'N/A'}</p>
                    <p class="text-sm">Date of Birth: ${item.dob || 'N/A'}</p>
                    <p class="text-sm">Event Location: ${item.event_location || 'N/A'}</p>
                `;
            case 'change_of_name':
                return `
                    <p class="text-sm">Old Name: ${item.old_name || 'N/A'}</p>
                    <p class="text-sm">New Name: ${item.new_name || 'N/A'}</p>
                `;
            case 'dedication':
                return `
                    <p class="text-sm">Parents: ${item.parents_names || 'N/A'}</p>
                    <p class="text-sm">Dedication Date: ${item.dedication_date || 'N/A'}</p>
                `;
            case 'lost_and_found':
                return `<p class="text-sm">Contact: ${item.phone_number || 'N/A'}</p>`;
            case 'missing_and_wanted':
                return `
                    <p class="text-sm">Gender: ${item.gender || 'N/A'}</p>
                    <p class="text-sm">Age: ${item.age || 'N/A'}</p>
                    <p class="text-sm">Height: ${item.height || 'N/A'}</p>
                    <p class="text-sm">Skin Color: ${item.skin_color || 'N/A'}</p>
                `;
            case 'news':
                return `
                    <p class="text-sm">Categories: ${item.category_names || 'N/A'}</p>
                    <p class="text-sm">Tags: ${item.tag_names || 'N/A'}</p>
                `;
            case 'obituary':
                return `
                    <p class="text-sm">Gender: ${item.gender || 'N/A'}</p>
                    <p class="text-sm">Age: ${item.age || 'N/A'}</p>
                    <p class="text-sm">Date of Birth: ${item.date_of_birth || 'N/A'}</p>
                `;
            case 'stolen_vehicle':
                return `
                    <p class="text-sm">Vehicle Make: ${item.vehicle_make || 'N/A'}</p>
                    <p class="text-sm">Color: ${item.vehicle_color || 'N/A'}</p>
                    <p class="text-sm">License Plate: ${item.license_plate || 'N/A'}</p>
                    <p class="text-sm">Stolen Location: ${item.stolen_location || 'N/A'}</p>
                    <p class="text-sm">Theft Date: ${item.theft_date || 'N/A'}</p>
                `;
            case 'wedding':
                return `
                    <p class="text-sm">Bride: ${item.bride_name || 'N/A'}</p>
                    <p class="text-sm">Groom: ${item.groom_name || 'N/A'}</p>
                    <p class="text-sm">Wedding Date: ${item.wedding_date || 'N/A'}</p>
                    <p class="text-sm">Venue: ${item.venue || 'N/A'}</p>
                `;
            case 'youtube':
                return `
                    <p class="text-sm">YouTube URL: <a href="${item.youtube_url || '#'}" class="text-blue-500 hover:underline" target="_blank">${item.youtube_url || 'N/A'}</a></p>
                    <p class="text-sm">Description: ${item.description || 'N/A'}</p>
                `;
            default:
                return '';
        }
    }
</script>