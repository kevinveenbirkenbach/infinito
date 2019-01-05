#!/bin/bash
(
  cd $(dirname $(readlink -f ${0}))/../;
  git submodule sync;
  git submodule foreach git pull origin master;
)
