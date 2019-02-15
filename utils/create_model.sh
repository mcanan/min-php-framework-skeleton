#!/bin/bash

CURRENT_DIR="$(dirname "$(readlink -f "$0")")"
PROJECT_DIR="$(dirname "$CURRENT_DIR")"

if [ ! -d "$PROJECT_DIR/app/models" ]; then
    echo "The project directory ($PROJECT_DIR) does not exist."
	exit
fi

read -p "Model name?: " M
if [[ "$M" = "" ]]; then exit; fi
read -p "Key? Ex: id (id): " ID
if [[ "$ID" = "" ]]; then ID=id; fi

TEMPLATE="$CURRENT_DIR/templates/model_sql.php"
VARS='{"model":"'$M'", "id":"'$ID'"}'
php $CURRENT_DIR/templates/gen.php "$PROJECT_DIR" "$TEMPLATE" "$VARS"
