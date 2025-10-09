<?php
$customsummary = get_sub_field('customsummary');

$border_repeater = get_sub_field('border');
$border = 'bottom';
if ($border_repeater && is_array($border_repeater) && isset($border_repeater[0]['bordersummary'])) {
    $border = $border_repeater[0]['bordersummary'];
}
?>

<?php if ($customsummary): ?>
    <section id="pagina-summary" class="summary-block">
        <div class="container summary-container">
            <?php foreach ($customsummary as $row):
                $title_summary = $row['titlesummary'] ?? '';
                $year_summary  = $row['yearsummary'] ?? '';
            ?>
                <div class="summary-item <?php echo esc_attr($border); ?>">
                    <?php if ($title_summary): ?>
                        <h2 class="summary-title"><?php echo esc_html($title_summary); ?></h2>
                    <?php endif; ?>

                    <?php if ($year_summary): ?>
                        <h3 class="summary-year"><?php echo esc_html($year_summary); ?></h3>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>


<style>
    .summary-block {
        margin-top: 50px;
        width: 100%;
        background-color: #f8f6f2;
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
    }

    .summary-container {
        max-width: 800px;
        width: 55%;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        padding: 0 20px;
        opacity: 1;
        filter: blur(0);
    }

    .summary-item.bottom {
        border-bottom: 1px solid #333;
    }

    .summary-item.top {
        border-top: 1px solid #333;
    }

    .summary-item.left {
        border-left: 1px solid #333;
    }

    .summary-item.right {
        border-right: 1px solid #333;
    }

    .summary-item.none {
        border: none;
    }

    .summary-item.full {
        border: 1px solid #333;
    }



    .summary-container:hover .summary-item {
        opacity: 0.3;
        filter: blur(1px);
    }

    .summary-container .summary-item:hover {
        opacity: 1;
        filter: blur(0);
        transform: scale(1.02);
    }



    .summary-title {
        font-size: 1.5rem;
    }

    .summary-year {
        font-size: 1.4rem;
        font-weight: 500;
        color: #7f7f7d;
    }

    @media screen and (max-width: 768px) {
        .summary-block {
            margin-top: 50px;
            width: 100%;
            background-color: #f8f6f2;
            display: flex;
            justify-content: center;
            margin-bottom: 50px;
        }

        .summary-container {
            width: 80%;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            padding: 0 20px;
            opacity: 1;
            filter: blur(0);
        }

        .summary-item.bottom {
            border-bottom: 1px solid #333;
        }

        .summary-item.top {
            border-top: 1px solid #333;
        }

        .summary-item.left {
            border-left: 1px solid #333;
        }

        .summary-item.right {
            border-right: 1px solid #333;
        }

        .summary-item.none {
            border: none;
        }

        .summary-item.full {
            border: 1px solid #333;
        }



        .summary-container:hover .summary-item {
            opacity: 0.3;
            filter: blur(1px);
        }

        .summary-container .summary-item:hover {
            opacity: 1;
            filter: blur(0);
            transform: scale(1.02);
        }



        .summary-title {
            font-size: 1.5rem;
        }

        .summary-year {
            font-size: 1.4rem;
            font-weight: 500;
            color: #7f7f7d;
        }

    }
</style>