(cd $(dirname $(readlink -f ${0}))/  &&
bash ./schema-validate.sh &&
bash ./test.sh &&
bash ./test-code-format.sh 
)
