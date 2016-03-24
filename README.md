Akeneo Spreadsheet Parser
=========================

This component is designed to extract data from spreadsheets, while being easy on resources, even for large files.

The current version of the spreadsheet parser works with csv and xlsx files.

[![Travis Build Status](https://travis-ci.org/akeneo-labs/spreadsheet-parser.svg?branch=master)](https://travis-ci.org/akeneo-labs/spreadsheet-parser)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/akeneo-labs/spreadsheet-parser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/akeneo-labs/spreadsheet-parser/?branch=master)

Installing the package
----------------------

From your application root:

```bash
    $ php composer.phar require --prefer-dist "akeneo-labs/spreadsheet-parser"
```

Usage
-----

To extract data from an XLSX spreadsheet, use the following code:

```php
    use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

    $workbook = SpreadsheetParser::open('myfile.xlsx');

    $myWorksheetIndex = $workbook->getWorksheetIndex('myworksheet');
    
    foreach ($workbook->createRowIterator($myWorksheetIndex) as $rowIndex => $values) {
        var_dump($rowIndex, $values);
    }
```

By using the CSV parser options, you can specify the format of your CSV file :

```php 
    use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

    $workbook = SpreadsheetParser::open('myfile.csv');

    $iterator = $workbook->createIterator(
        0,
        [
            'encoding'  => 'UTF-8',
            'length'    => null,
            'delimiter' => ',',
            'enclosure' => '"',
            'escape'    => '\\'
        ]
    );
   
    
    foreach ($workbook->createIterator($myWorksheetIndex) as $rowIndex => $values) {
        var_dump($rowIndex, $values);
    }
```

Running the tests
-----------------

To run unit tests, use phpspec:

```bash
    $ php bin/phpspec run
```

To run integration tests, use phpunit:

```bash
    $ phpunit
```
