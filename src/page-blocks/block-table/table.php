<?php
$table_title        = get_sub_field('table_title');
$table_head_text    = get_sub_field('table_head_text');
$table_head_columns = get_sub_field('table_head_columns');
$table_rows         = get_sub_field('table_rows');
?>

<section class="block-table">
    <div class="container-table">
        <?php if ($table_head_text): ?>
            <div class="table-head-text">
                <?= $table_head_text; ?>
            </div>
        <?php endif; ?>

        <!-- FILTER & RESET -->
        <div class="table-controls" style="margin:1rem; display:grid; grid-template-columns:4fr 2fr 0.5fr;">
            <input type="text" id="table-filter" placeholder="Filter tabel..."
                style="padding:0.3rem 0.7rem; font-size:1rem; margin-right:0.5rem;
                grid-column:2/3; background-color:#f8f6f2; border:1px solid #94928dff;
                border-radius:5px;">
            <button id="table-reset"
                style="padding:0.3rem 0.4rem; font-size:1rem; color:#fff;
                background-color:#1a5428c5; border-radius:4px; border:none;">Reset</button>
        </div>

        <!-- TABEL -->
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

        <!-- PAGINERING -->
        <div class="table-pagination-controls" style="margin:1rem; display:flex; align-items:center; gap:1rem;">
            <span style="color:#555;">Totaal items: <strong id="total-items" style="color:#555;">0</strong></span>

            <label for="items-per-page"
                style="margin-left:1rem; color:#555;">Items per pagina:</label>
            <select id="items-per-page"
                style="padding:0.3rem 0.7rem; font-size:1rem; border-radius:5px;
                border:1px solid #94928dff; color:#fff; background-color:#1a5428c5;
                font-weight:700; cursor:pointer;">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>

            <div class="pagination-buttons" style="margin-left:auto; display:flex;">
                <button id="prev-page" style="padding:0.4rem 0.7rem;
                    background-color:#1a5428c5; border-radius:5px; border:none;
                    color:#fff; cursor:pointer;">&laquo; Vorige</button>

                <span id="current-page" style="padding:0.3rem; color:#555;">1</span>
                <span style="color:#555;" class="span"> / </span>
                <span id="total-pages" style="padding:0.3rem; color:#555;">1</span>

                <button id="next-page" style="padding:0.4rem 0.7rem;
                    background-color:#1a5428c5; border-radius:5px; border:none;
                    color:#fff; cursor:pointer;">Volgende &raquo;</button>
            </div>
        </div>
    </div>
</section>

<style>
    #current-page,
    #total-pages,
    .span {
        margin: 0.3rem;
        padding: 0.3rem;
    }

    .block-table {
        margin: 1rem 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .block-table .table-head-text {
        margin-left: 2rem;
        margin-bottom: 1.5rem;
        font-size: 1rem;
        color: #555;
    }

    /* RESPONSIVE WRAPPER */
    .block-table .table-wrapper {
        margin: 1rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .block-table table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 100%; /* schaalbaar, geen horizontale scroll nodig */
        table-layout: fixed; /* voorkomt uitrekken van kolommen */
    }

    .block-table th,
    .block-table td {
        padding: 0.75rem 1rem;
        border: 0.5px solid #ddd;
        text-align: left;
        background: #fff;
        white-space: normal;       /* laat tekst afbreken */
        word-break: break-word;    /* lange woorden breken */
    }

    .block-table td {
        color: #555;
    }

    .block-table th {
        background: #1a5428c5;
        color: white;
        cursor: pointer;
        position: relative;
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

    .block-table tbody tr:nth-child(even) td {
        background: #1a542817;
    }

    /* MOBIEL RESPONSIVE */
    @media (max-width: 600px) {

        .container-table {
            max-width: 600px;
        }

        .block-table th,
        .block-table td {
            padding: 0.6rem 0.5rem;
            font-size: 0.85rem;
        }

        .table-controls {
            grid-template-columns: 1fr !important;
            gap: 0.5rem;
        }

        #table-filter {
            grid-column: 1 / 2 !important;
            width: 100%;
        }

        .pagination-buttons {
            flex-wrap: wrap;
            gap: .5rem;
        }

        #prev-page,
        #next-page {
            width: 47%;
        }
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

    const itemsPerPageSelect = document.getElementById('items-per-page');
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');
    const currentPageSpan = document.getElementById('current-page');
    const totalPagesSpan = document.getElementById('total-pages');
    const totalItemsSpan = document.getElementById('total-items');
    const totalPagesOutput = document.getElementById('total-pages-output');

    let currentPage = 1;
    let itemsPerPage = parseInt(itemsPerPageSelect.value);
    let filteredRows = [...originalRows];

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const colIndex = parseInt(header.dataset.colIndex);
            const isAsc = header.classList.contains('sorted-asc');

            filteredRows.sort((a, b) => {
                const aText = a.cells[colIndex].textContent.trim();
                const bText = b.cells[colIndex].textContent.trim();
                const aNum = parseFloat(aText.replace(',', '.'));
                const bNum = parseFloat(bText.replace(',', '.'));

                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return isAsc ? bNum - aNum : aNum - bNum;
                }
                return isAsc ?
                    bText.localeCompare(aText, undefined, { numeric: true }) :
                    aText.localeCompare(bText, undefined, { numeric: true });
            });

            headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
            header.classList.toggle('sorted-asc', !isAsc);
            header.classList.toggle('sorted-desc', isAsc);

            currentPage = 1;
            renderTablePage();
        });
    });

    filterInput.addEventListener('input', () => {
        const filterValue = filterInput.value.toLowerCase();
        filteredRows = originalRows.filter(row => {
            const rowText = Array.from(row.cells).map(td => td.textContent.toLowerCase()).join(' ');
            return rowText.includes(filterValue);
        });
        currentPage = 1;
        renderTablePage();
    });

    resetButton.addEventListener('click', () => {
        filterInput.value = '';
        filteredRows = [...originalRows];
        headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
        currentPage = 1;
        renderTablePage();
    });

    function renderTablePage() {
        tbody.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        filteredRows.slice(start, end).forEach(row => tbody.appendChild(row));

        currentPageSpan.textContent = currentPage;
        totalPagesSpan.textContent = totalPages;
        totalItemsSpan.textContent = filteredRows.length;
        totalPagesOutput.textContent = totalPages;

        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;
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
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTablePage();
        }
    });

    renderTablePage();
});
</script>
