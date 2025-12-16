#!/bin/bash

# Accordion
sass --watch src/page-blocks/block-accordion_field/accordion.scss:assets/css/accordion/accordion.css --style=compressed &
sass --watch src/page-blocks/block-accordion_field/accordion.scss:assets/css/accordion/accordion_full.css --style=expanded &

# Breadcrumbs
sass --watch src/page-blocks/block-breadcrumbs/breadcrumbs.scss:assets/css/breadcrumbs/breadcrumbs.css --style=compressed &
sass --watch src/page-blocks/block-breadcrumbs/breadcrumbs.scss:assets/css/breadcrumbs/breadcrumbs_full.css --style=expanded &

# Button

sass --watch src/page-blocks/block-button_field/button.scss:assets/css/button/button.css --style=compressed &
sass --watch src/page-blocks/block-button_field/button.scss:assets/css/button/button_full.css --style=expanded &

sass --watch src/page-blocks/block-post_grid/post-grid.scss:assets/css/post-grid/post-grid.css --style=compressed &
sass --watch src/page-blocks/block-post_grid/post-grid.scss:assets/css/post-grid/post-grid_full.css --style=expanded &

sass --watch src/page-blocks/block-image_field/image.scss:assets/css/image/image.css --style=compressed &
sass --watch src/page-blocks/block-image_field/image.scss:assets/css/image/image_full.css --style=expanded &

wait

# chmod +x sass_compile.sh
# ./sass_compile.sh