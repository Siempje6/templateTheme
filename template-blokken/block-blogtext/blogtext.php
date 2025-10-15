<?php
$blogtekst = get_sub_field('blogtekst');
?>

<section id="pagina-blogtext" class="blogtext-block">
    <div class="container blogtext-container">
        <?php if (!empty($blogtekst)): ?>
            <div class="blog-text">
                <?php echo $blogtekst; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .blogtext-block {
        width: 100%;
        background-color: #f8f6f2;
        margin-top: 10px;
    }

    .blogtext-container {
        width: 100%;
        margin: 0 auto;
        max-width: 800px;
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .blog-text {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    @media screen and (max-width: 768px) {
        .blogtext-block {
        width: 100%;
        background-color: #f8f6f2;
        margin-top: 10px;
    }

    .blogtext-container {
        width: 70%;
        margin: 0 auto;
        max-width: 800px;
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .blog-text {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 10px;
    }
    }
</style>
