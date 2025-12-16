#!/usr/bin/env bash
#
# Generate WooCommerce Subscriptions stubs from the source directory.
#

HEADER=$'/**\n * Generated stub declarations for WooCommerce Subscriptions.\n * @see https://woocommerce.com\n * @see https://github.com/php-stubs/woocommerce-subscriptions-stubs\n */'

FILE="woocommerce-subscriptions-stubs.php"

set -e

test -f "$FILE"
test -d "woocommerce-subscriptions"

# Exclude globals.
"$(dirname "$0")/vendor/bin/generate-stubs" \
    --include-inaccessible-class-nodes \
    --force \
    --finder=finder.php \
    --header="$HEADER" \
    --functions \
    --classes \
    --interfaces \
    --traits \
    --out="$FILE"
