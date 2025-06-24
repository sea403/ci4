#!/bin/bash

# Path to Swagger PHP binary
OPENAPI="./vendor/bin/openapi"

# Path to scan (change 'app' if needed)
SCAN_PATH="app"

# Output file
OUTPUT_FILE="public/swagger.json"

# Run the generator
echo "Generating OpenAPI documentation..."
$OPENAPI $SCAN_PATH -o $OUTPUT_FILE

# Result
if [ $? -eq 0 ]; then
  echo "✅ Swagger documentation generated at $OUTPUT_FILE"
else
  exit 1
fi
