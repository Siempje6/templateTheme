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

sass --watch src/page-blocks/page-blocks.scss:css/page-styling/style_compressed.css --style=compressed &
sass --watch src/page-blocks/page-blocks.scss:css/page-styling/style.css --style=expanded &
sass --watch src/page-blocks/page-blocks.scss:css/page-styling/style_compressed.css --style=compressed &
sass --watch src/page-blocks/page-blocks.scss:css/page-styling/style.css --style=expanded &

wait

# chmod +x sass_compile.sh
# ./sass_compile.sh