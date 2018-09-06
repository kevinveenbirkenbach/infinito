(
  cd $(dirname $(readlink -f ${0}));
  bash ./submodule_sync.sh
  bash ./build.sh
  bash ./schema-update.sh
)
