#!/bin/bash

HERE="$(readlink -e "$(dirname $0)")"

cd /tmp
if [ ! -e PHP_CodeSniffer ]; then
  git clone https://github.com/squizlabs/PHP_CodeSniffer.git
fi

function which_php() {
  for ver in ".default" "8.0" "7.0" ""; do
    echo "Looking for php${ver}"
    PHP=$(which php${ver})
    if [ $? -eq 0 ]; then
      echo "Php found: ${PHP}"
      return
    fi
  done
  echo "Php not found !"
}

which_php

if [ -z ${PHP} ]; then
  echo "PHP is mandatory !"
  exit
fi

echo "Verifiyng code quality..."
report_file=${HERE}/php_lint_report.txt
${PHP} /tmp/PHP_CodeSniffer/bin/phpcs -v -w --report-file=${report_file} ${HERE}
cd -

echo "#####"
echo "Report is available at: ${report_file}"
