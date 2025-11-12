<?php

$table_title        = get_sub_field('table_title');
$table_head_text    = get_sub_field('table_head_text');
$table_head_columns = get_sub_field('table_head_columns');
$table_rows         = get_sub_field('table_rows');
?>

<section class="block-table">
    <div class="container">
        <?php if ($table_head_text): ?>
            <div class="table-head-text">
                <?= $table_head_text; ?>
            </div>
        <?php endif; ?>

        <div class="table-controls" style="margin-left:1rem; margin-right: 1rem; margin-bottom:1rem;
                    display: grid; grid-template-columns: 4fr 2fr 0.5fr;">
            <input type="text" id="table-filter" placeholder="Filter tabel..." style="padding:0.3rem 0.7rem; font-size:1rem; margin-right:0.5rem;
                                                                                      grid-column: 2/3; background-color: #f8f6f2; border: 1px solid #94928dff;
                                                                                      border-radius: 5px;">
            <button id="table-reset" style="padding:0.3rem 0.4rem; font-size:1rem;
                                            color: #fff; background-color: #1a5428c5;
                                            border-radius: 4px; border: none;">Reset</button>
        </div>

        <div class="table-wrapper">
            <table>
                <?php if ($table_head_columns): ?>
                    <thead>
                        <tr>
                            <?php foreach ($table_head_columns as $index => $col): ?>
                                <th data-col-index="<?= $index ?>" class="sortable">
                                    <?= esc_html($col['column_label']); ?>
                                    <span class="sort-arrow">⬍</span>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                <?php endif; ?>

                <?php if ($table_rows): ?>
                    <tbody>
                        <?php foreach ($table_rows as $row): ?>
                            <?php $cells = $row['cells_repeater'] ?? []; ?>
                            <tr>
                                <?php if ($cells): ?>
                                    <?php foreach ($cells as $cell): ?>
                                        <td><?= esc_html($cell['cell_content']); ?></td>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <td colspan="<?= count($table_head_columns); ?>">(Lege rij)</td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>

        <div class="table-pagination-controls" style="margin:1rem; display:flex; align-items:center; gap:1rem;">
            <label for="items-per-page"
                   style="color: #555; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                   margin-left:1rem;">Items per pagina:</label>
            <select id="items-per-page" 
                    style="padding:0.3rem 0.7rem; font-size:1rem; border-radius:5px; border:1px solid #94928dff;
                    color: #fff; background-color: #1a5428c5; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                    font-weight: 700; cursor: pointer;">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
            </select>

            <div class="pagination-buttons" style="margin-left:auto; display:flex;">
                <button id="prev-page" style="padding:0.4rem 0.7rem;
                                              font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                                              background-color: #1a5428c5; border-radius: 5px; border:none;
                                              color: #fff; cursor:pointer;">&laquo; Vorige</button>
                <span id="current-page" 
                      style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                             color:#555; padding:0.3rem; margin:0rem 0.3rem;">
                      1
                </span> 
                <span style="color: #555;
                             font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                             color:#555; padding:0.3rem; margin:0rem 0.3rem;"> / </span>
                <span id="total-pages"
                      style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                             color:#555; padding:0.3rem; margin:0rem 0.3rem;">
                    1
                </span>
                <button id="next-page" style="padding:0.4rem 0.7rem;
                                              font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                                              background-color: #1a5428c5; border-radius: 5px; border:none;
                                              color: #fff; cursor:pointer;">Volgende &raquo;</button>
            </div>
        </div>
    </div>
</section>

<style>
    .block-table {
        margin: 1rem 0;
    }

    .block-table .table-head-text {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        margin-left: 2rem;
        margin-bottom: 1.5rem;
        font-size: 1rem;
        color: #555;
    }

    .block-table .table-wrapper {
        margin-left: 1rem;
        margin-right: 1rem;
        overflow-x: auto;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .block-table table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 600px;
    }

    .block-table thead tr:first-child th:first-child {
        border-top-left-radius: 10px;
    }

    .block-table thead tr:first-child th:last-child {
        border-top-right-radius: 10px;
    }

    .block-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }

    .block-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }

    .block-table th,
    .block-table td {
        padding: 0.75rem 1rem;
        border: 0.5px solid #ddd;
        text-align: left;
        background: #fff;
    }

    .block-table th {
        color: white;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 1.1rem;
        position: relative;
        cursor: pointer;
        user-select: none;
    }

    .block-table th .sort-arrow {
        font-size: 0.8rem;
        margin-left: 0.3rem;
        transition: transform 0.2s;
    }

    .block-table th.sorted-asc .sort-arrow {
        transform: rotate(180deg);
    }

    .block-table th.sorted-desc .sort-arrow {
        transform: rotate(0deg);
    }

    .block-table td {
        color: #555;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .block-table thead th {
        background: #1a5428c5;
        font-weight: 600;
    }

    .block-table tbody tr:nth-child(even) td {
        background: #1a542817;
    }

    .block-table tbody tr:last-child td:first-child,
    .block-table tbody tr:last-child td:last-child {
        position: relative;
        z-index: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.block-table table');
        const headers = table.querySelectorAll('th.sortable');
        const tbody = table.querySelector('tbody');
        const filterInput = document.getElementById('table-filter');
        const resetButton = document.getElementById('table-reset');

        const originalRows = Array.from(tbody.querySelectorAll('tr'));

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const colIndex = parseInt(header.dataset.colIndex);
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const isAsc = header.classList.contains('sorted-asc');

                rows.sort((a, b) => {
                    const aText = a.cells[colIndex].textContent.trim();
                    const bText = b.cells[colIndex].textContent.trim();

                    const aNum = parseFloat(aText.replace(',', '.'));
                    const bNum = parseFloat(bText.replace(',', '.'));

                    if (!isNaN(aNum) && !isNaN(bNum)) {
                        return isAsc ? bNum - aNum : aNum - bNum;
                    }
                    return isAsc ? bText.localeCompare(aText, undefined, {
                            numeric: true
                        }) :
                        aText.localeCompare(bText, undefined, {
                            numeric: true
                        });
                });

                rows.forEach(row => tbody.appendChild(row));

                headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
                header.classList.toggle('sorted-asc', !isAsc);
                header.classList.toggle('sorted-desc', isAsc);
            });
        });

        filterInput.addEventListener('input', () => {
            const filterValue = filterInput.value.toLowerCase();
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.forEach(row => {
                const rowText = Array.from(row.cells).map(td => td.textContent.toLowerCase()).join(' ');
                row.style.display = rowText.includes(filterValue) ? '' : 'none';
            });
        });

        resetButton.addEventListener('click', () => {

            filterInput.value = '';
            Array.from(tbody.querySelectorAll('tr')).forEach(row => row.style.display = '');

            tbody.innerHTML = '';
            originalRows.forEach(row => tbody.appendChild(row));

            headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('.block-table table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    const itemsPerPageSelect = document.getElementById('items-per-page');
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');
    const currentPageSpan = document.getElementById('current-page');
    const totalPagesSpan = document.getElementById('total-pages');

    let currentPage = 1;
    let itemsPerPage = parseInt(itemsPerPageSelect.value);

    function renderTablePage() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? '' : 'none';
        });

        const totalPages = Math.ceil(rows.length / itemsPerPage);
        currentPageSpan.textContent = currentPage;
        totalPagesSpan.textContent = totalPages;

        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
    }

    itemsPerPageSelect.addEventListener('change', () => {
        itemsPerPage = parseInt(itemsPerPageSelect.value);
        currentPage = 1;
        renderTablePage();
    });

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTablePage();
        }
    });

    nextBtn.addEventListener('click', () => {
        const totalPages = Math.ceil(rows.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTablePage();
        }
    });

    renderTablePage();
});
</script>
