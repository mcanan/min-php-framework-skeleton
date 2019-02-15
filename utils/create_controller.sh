#!/bin/bash

CURRENT_DIR="$(dirname "$(readlink -f "$0")")"
PROJECT_DIR="$(dirname "$CURRENT_DIR")"

if [ ! -d "$PROJECT_DIR/app/models" ]; then
    echo "The project directory ($PROJECT_DIR) does not exist."
	exit
fi

read -p "Controller name?: " C
if [[ "$C" = "" ]]; then exit; fi
read -p "Controller name in singular? ($C): " CS
if [[ "$CS" = "" ]]; then CS=$C; fi
read -p "With authentication? [y/n]" yn
case $yn in
    [Yy]* ) 
        AUTH=1
        ;;
    * ) 
        AUTH=0
        ;;
esac
read -p "Extends from? Ex: \\mcanan\\framework\\AuthController (\\mcanan\\framework\\BasicController): " EXTENDS
if [[ "$EXTENDS" = "" ]]; then EXTENDS="\\\mcanan\\\framework\\\BasicController"; fi
read -p "Model name? ($C): " M
if [[ "$M" = "" ]]; then M=$C; fi
read -p "Key? Ex: id (id): " ID
if [[ "$ID" = "" ]]; then ID=id; fi

TEMPLATE="$CURRENT_DIR/templates/controller.php"
VARS='{"controller":"'$C'", "auth":"'$AUTH'", "extends":"'$EXTENDS'", "id":"'$ID'", "model":"'$M'", "controller_singular":"'$CS'"}'
php $CURRENT_DIR/templates/gen.php "$PROJECT_DIR" "$TEMPLATE" "$VARS"
