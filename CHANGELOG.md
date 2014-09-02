# CHANGELOG

## 1.1.5

### Bug fixes

 * set default system encoding to UTF8

## 1.1.4

## Improvements

 * Skip converting when reading CSV if source encoding is the same as target encoding

## 1.1.3

### Bug fixes

 * Fixed non-static method error in XlsxParser (Github issue #6)

## 1.1.2

### Bug fixes

 * first row index of CSV is 1 except of 0

## 1.1.1

### Enhancements

* XLSM extension support

## 1.1.0

### Features

* CSV support

### BC Breaks

* WorkbookInterface is now SpreasheetInterface
* WorkbookLoaderInterface is now SpreadsheetLoaderInterface

