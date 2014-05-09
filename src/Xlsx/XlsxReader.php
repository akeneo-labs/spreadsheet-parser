<?php

namespace Akeneo\Component\SpreadsheetParser\Xlsx;

/**
 * Entry point for XLSX reader
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class XlsxReader
{
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
    const ROW_BUILDER_CLASS = 'Pim\Bundle\ExcelConnectorBundle\Excel\RowBuilder';

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
     * @staticvar string Workbook class
     */
    const WORKBOOK_CLASS = 'Akeneo\Component\SpreadsheetParser\Xlsx\Workbook';

    /**
     * @var WorkbookLoader
     */
    private static $workbookLoader;

    /**
     * Opens an XLSX file
     *
     * @param string $path
     *
     * @return Workbook
     */
    public static function open($path)
    {
        return static::getWorkbookLoader()->open($path);
    }

    /**
     * @return WorkbookLoader
     */
    public static function getWorkbookLoader()
    {
        if (!isset(self::$workbookLoader)) {
            self::$workbookLoader = new WorkbookLoader(
                static::createArchiveLoader(),
                static::createRelationshipsLoader(),
                static::createStylesLoader(),
                static::createWorksheetListReader(),
                static::createValueTransformerFactory(),
                static::createRowIteratorFactory(),
                static::WORKBOOK_CLASS
            );
        }

        return self::$workbookLoader;
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
    protected function createRelationshipsLoader()
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
