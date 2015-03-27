rmdb="rm /var/www/ontwikkel/data_crawler/import.io/db/*"
emptydb="php /var/www/ontwikkel/data_crawler/emptydb.php /var/www/ontwikkel/data_crawler/"

crawlers[0]="timeout 1 /var/www/ontwikkel/data_crawler/import.io/import.io -crawl /var/www/ontwikkel/data_crawler/crawlers/LL-NL_crawler.json /var/www/ontwikkel/data_crawler/import.io/auth_config.json"
crawlers[1]="timeout 1 /var/www/ontwikkel/data_crawler/import.io/import.io -crawl /var/www/ontwikkel/data_crawler/crawlers/Rietveld_crawler.json /var/www/ontwikkel/data_crawler/import.io/auth_config.json"
crawlers[2]="timeout 172800 /var/www/ontwikkel/data_crawler/import.io/import.io -crawl /var/www/ontwikkel/data_crawler/crawlers/lampen24_crawler.json /var/www/ontwikkel/data_crawler/import.io/auth_config.json"

klanten[0]="php -q /var/www/ontwikkel/data_crawler/procesData.php -clampenlichtNL"
klanten[1]="php -q /var/www/ontwikkel/data_crawler/procesData.php -cRietveldLicht"
klanten[2]="php -q /var/www/ontwikkel/data_crawler/procesData.php -cLampen24"

${rmdb}
${emptydb}
${crawlers[0]}
${klanten[0]}


${rmdb}no
${crawlers[1]}
${klanten[1]}

${rmdb}
${emptydb}
${crawlers[2]}
${klanten[2]}
${rmdb}
