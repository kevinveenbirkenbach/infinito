#!/bin/bash
echo "Untracked and ignored files will be deleted..."
cd "$(dirname "$(readlink -f "${0}")")/../" &&
git clean -fXd
