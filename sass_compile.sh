#!/bin/bash

# Accordion
sass --watch src/page-blocks/block-accordion_field/accordion.scss:css/accordion/accordion.css --style=compressed &
sass --watch src/page-blocks/block-accordion_field/accordion.scss:css/accordion/accordion_full.css --style=expanded &

# Breadcrumbs
sass --watch src/page-blocks/block-breadcrumbs/breadcrumbs.scss:css/breadcrumbs/breadcrumbs.css --style=compressed &
sass --watch src/page-blocks/block-breadcrumbs/breadcrumbs.scss:css/breadcrumbs/breadcrumbs_full.css --style=expanded &

# Button

sass --watch src/page-blocks/block-button_field/button.scss:css/button/button.css --style=compressed &
sass --watch src/page-blocks/block-button_field/button.scss:css/button/button_full.css --style=expanded &

sass --watch src/page-blocks/block-post_grid/post-grid.scss:css/post-grid/post-grid.css --style=compressed &
sass --watch src/page-blocks/block-post_grid/post-grid.scss:css/post-grid/post-grid_full.css --style=expanded &

wait

# chmod +x sass_compile.sh
# ./sass_compile.sh