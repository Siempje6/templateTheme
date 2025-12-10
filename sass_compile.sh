#!/bin/bash
# Run SASS compile for accordion block
sass src/page-blocks/block-accordion_field/accordion.scss css/accordion/accordion.css --style=compressed
sass src/page-blocks/block-accordion_field/accordion.scss css/accordion/accordion_full.css --style=expanded

sass src/page-blocks/block-breadcrumbs/breadcrumbs.scss css/breadcrumbs/breadcrumbs.css --style=compressed
sass src/page-blocks/block-breadcrumbs/breadcrumbs.scss css/breadcrumbs/breadcrumbs_full.css --style=expanded


# chmod +x sass_compile.sh
# ./sass_compile.sh