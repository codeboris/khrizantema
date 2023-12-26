<?php


namespace shop\services;


class ProductReader
{
    /**
     * @param $file
     * @return ProductRow[]
    */

    public function readCsv($file): iterable
    {
        $f = fopen($file->tempName, 'r');

        while ($row = fgetcsv($f)) {

            $row = new ProductRow();
            $row->code = $row[0];
            $row->priceOld = $row[1];
            $row->priceNew = $row[2];
            $row->modificationCode = $row[3];
            $row->modificationPrice = $row[4];

            yield $row;
        }

        fclose($f);

    }

}