#!/bin/bash
cd "$(dirname "$(readlink -f "${0}")")/" &&
shellcheck ./*.sh
