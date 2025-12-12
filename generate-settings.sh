PROJECT_DIR="/Users/gebruiker/Local Sites/themplate/app/public/wp-content/themes/templateTheme"
THEME_NAME="$(basename "$PROJECT_DIR")"
STUBS_DIR="$PROJECT_DIR/vendor/php-stubs/wordpress-stubs"

mkdir -p "$PROJECT_DIR/.vscode"

cat > "$PROJECT_DIR/.vscode/settings.json" <<EOL
{
    "intelephense.environment.includePaths": [
        "$PROJECT_DIR/wp-includes",
        "$PROJECT_DIR/wp-admin/includes",
        "$STUBS_DIR"
    ],
    "intelephense.files.associations": [
        "*.php"
    ],
    "intelephense.files.maxSize": 5000000,
    "intelephense.stubs": [
        "wordpress"
    ],
    "intelephense.completion.insertUseDeclaration": true
}
EOL

# Installeer stubs als ze nog niet bestaan
if [ ! -d "$STUBS_DIR" ]; then
    echo "WordPress stubs niet gevonden, installeren via Composer..."
    cd "$PROJECT_DIR" || exit
    composer require --dev php-stubs/wordpress-stubs
fi

echo "✅ settings.json aangemaakt in $PROJECT_DIR/.vscode en stubs klaar."
