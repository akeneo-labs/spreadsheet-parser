<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Entry point for XLSX reader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2014 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class XlsxParser
{
    /**
     * @staticvar string the name of the format
     */
    const FORMAT_NAME = 'xlsx';

    /**
     * @staticvar string the name of the macro format
     */
    const MACRO_FORMAT_NAME = 'xlsm';

    /**
     * @staticvar string Archive class
     */
    const ARCHIVE_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\Archive';

    /**
     * @staticvar string Relationships class
     */
    const RELATIONSHIPS_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\Relationships';

    /**
     * @staticvar string RowBuilder class
     */
    const ROW_BUILDER_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\RowBuilder';

    /**
     * @staticvar string RowIterator class
     */
    const ROW_ITERATOR_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\RowIterator';

    /**
     * @staticvar string SharedStrings class
     */
    const SHARED_STRINGS_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\SharedStrings';

    /**
     * @staticvar string Styles class
     */
    const STYLES_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\Styles';

    /**
     * @staticvar string ValueTransformer class
     */
    const VALUE_TRANSFORMER_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\ValueTransformer';

    /**
     * @staticvar string Spreadsheet class
     */
    const WORKBOOK_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\Spreadsheet';

    /**
     * @var SpreadsheetLoader
     */
    private static $spreadsheetLoader;

    /**
     * Opens an XLSX file
     *
     * @param string $path
     *
     * @return Spreadsheet
     */
    public static function open($path)
    {
        return static::getSpreadsheetLoader()->open($path);
    }

    /**
     * @return SpreadsheetLoader
     */
    public static function getSpreadsheetLoader()
    {
        if (!isset(self::$spreadsheetLoader)) {
            self::$spreadsheetLoader = new SpreadsheetLoader(
                static::createArchiveLoader(),
                static::createRelationshipsLoader(),
                static::createSharedStringsLoader(),
                static::createStylesLoader(),
                static::createWorksheetListReader(),
                static::createValueTransformerFactory(),
                static::createRowIteratorFactory(),
                static::WORKBOOK_CLASS
            );
        }

        return self::$spreadsheetLoader;
    }

    /**
     * @return ArchiveLoader
     */
    protected static function createArchiveLoader()
    {
        return new ArchiveLoader(static::ARCHIVE_CLASS);
    }

    /**
     * @return RelationshipsLoader
     */
    protected static function createRelationshipsLoader()
    {
        return new RelationshipsLoader(static::RELATIONSHIPS_CLASS);
    }

    /**
     * @return SharedStringsLoader
     */
    protected static function createSharedStringsLoader()
    {
        return new SharedStringsLoader(static::SHARED_STRINGS_CLASS);
    }

    /**
     * @return StylesLoader
     */
    protected static function createStylesLoader()
    {
        return new StylesLoader(static::STYLES_CLASS);
    }

    /**
     * @return WorksheetListReader
     */
    protected static function createWorksheetListReader()
    {
        return new WorksheetListReader();
    }

    /**
     * @return ValueTransformerFactory
     */
    protected static function createValueTransformerFactory()
    {
        return new ValueTransformerFactory(static::createDateTransformer(), static::VALUE_TRANSFORMER_CLASS);
    }

    /**
     * @return DateTransformer
     */
    protected static function createDateTransformer()
    {
        return new DateTransformer();
    }

    /**
     * @return RowBuilderFactory
     */
    protected static function createRowBuilderFactory()
    {
        return new RowBuilderFactory(static::ROW_BUILDER_CLASS);
    }

    /**
     * @return ColumnIndexTransformer
     */
    protected static function createColumnIndexTransformer()
    {
        return new ColumnIndexTransformer();
    }

    /**
     * @return RowIteratorFactory
     */
    protected static function createRowIteratorFactory()
    {
        return new RowIteratorFactory(
            static::createRowBuilderFactory(),
            static::createColumnIndexTransformer(),
            static::ROW_ITERATOR_CLASS
        );
    }
}
