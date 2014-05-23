Akeneo Spreadsheet Parser
=========================

This component is designed to extract data from spreadsheets, while being easy on resources, even for large files.

The actual version of the spreadsheet parser only works with xlsx files.


Installing the package
----------------------

From your application root:

    $ php composer.phar require --prefer-dist "akeneo/excel-connector-bundle"


Usage
-----

To extract data from a spreadsheet, use the following code:

    <?php
    
    use Akeneo\Component\SpreadsheetParser\SpreadsheetParser;

    $workbook = SpreadsheetParser::open('myfile.xlsx');

    $myWorksheetIndex = $workbook->getWorksheetIndex('myworksheet');
    
    foreach ($workbook->createIterator($myWorksheetIndex) as $rowIndex => $values) {
        var_dump($rowIndex, $values);
    }
