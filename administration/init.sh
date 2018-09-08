(
  cd $(dirname $(readlink -f ${0}));
  bash ./submodule-init.sh
  bash ./build.sh
  bash ./schema-update.sh
)
