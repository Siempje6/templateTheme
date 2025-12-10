#!/bin/bash
# Run SASS compile for accordion block
sass src/page-blocks/block-accordion_field/accordion.scss css/accordion/accordion.css --style=compressed
sass src/page-blocks/block-accordion_field/accordion.scss css/accordion/accordion_full.css --style=expanded

# ./sass_compile.sh