#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/" || exit 1
echo "Run shellcheck..."
shellcheck ./*.sh
