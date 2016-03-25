# CHANGELOG

## 1.2.0 (2016-03-25)
 - Use maintained versions of the symfony component

## 1.1.7 (2015-10-05)
 - Migrate to AkeneoLabs

## 1.1.6 (2015-08-12)
 - Compatible with Akeneo 1.4

## 1.1.5 (2014-09-02)
### Bug fixes
 - set default system encoding to UTF8

## 1.1.4 (2014-08-08)
## Improvements
 - Skip converting when reading CSV if source encoding is the same as target encoding

## 1.1.3 (2014-06-25)
### Bug fixes
 - Fixed non-static method error in XlsxParser (Github issue #6)

## 1.1.2 (2014-06-18)
### Bug fixes
 - first row index of CSV is 1 except of 0

## 1.1.1 (2014-06-15)
### Enhancements
 - XLSM extension support

## 1.1.0 (2014-06-09)
### Features
 - CSV support

### BC Breaks
 - WorkbookInterface is now SpreasheetInterface
 - WorkbookLoaderInterface is now SpreadsheetLoaderInterface

## 1.0.0 (2014-05-24)
 - Initial release
