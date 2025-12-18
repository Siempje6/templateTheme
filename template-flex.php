<?php
/* 
Template Name: Flexibele Pagina 
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css">


</head>

<body <?php body_class(); ?>>
    <?php get_template_part('template-parts/body'); ?>
    <?php wp_body_open(); ?>


    <style>
        .site-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .site-main {
            flex: 1;
        }

        .header-grid,
        .footer-grid {
            display: grid;
            max-width: 1980px;
            width: 100%;
            margin: 0 auto;
            gap: 10px;
        }

        .header-column {
            border: 1px solid blue;
            display: flex;
            flex-direction: column;
            padding: 5px;
            border-radius: 4px;
        }

        .footer-column {
            border: 1px solid green;
            display: flex;
            flex-direction: column;
            padding: 10px;
            border-radius: 4px;
        }

        .default-page-content {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .comments-area {
            margin-top: 40px;
        }

        .comments-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .comment-list {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .comment-list li {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .comment-list li p {
            margin: 0.3rem 0;
        }

        .comment-form {
            margin-top: 30px;
        }

        .comment-form a {
            color: #1a5428;
        }

        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.95rem;
        }

        .comment-form input[type="submit"]:hover {
            background-color: #555;
        }

        @media screen and (max-width: 1024px) {

            .header-grid,
            .footer-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }

        @media screen and (max-width: 768px) {

            .header-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .default-page-content {
                margin: 20px;
                padding: 15px;
            }
        }

        /*
        .column-item,
        .header-column,
        .footer-column {
            border: none !important;
        }
        */

    </style>

    <?php wp_footer(); ?>
</body>

</html>