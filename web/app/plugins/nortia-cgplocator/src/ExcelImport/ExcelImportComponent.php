<?php

namespace NortiaCGPLocator\ExcelImport;

use Shuchkin\SimpleXLSX;
use Shuchkin\SimpleXLS;

class ExcelImportComponent
{
    public function __construct()
    {
    }

    private function openXLSX(mixed $file, bool $isData = true, bool $debug = false): SimpleXLSX
    {
        try {
            return new SimpleXLSX($file, $isData, $debug);
        } catch (\Exception $e) {
            throw new \WP_Error($e->getMessage());
        }
    }

    private function openXLS(mixed $file, bool $isData = true, bool $debug = false): SimpleXLS
    {
        try {
            return new SimpleXLS($file, $isData, $debug);
        } catch (\Exception $e) {
            throw new \WP_Error($e->getMessage());
        }
    }

    public function extract(array $file)
    {
        $data = [];

        if ($file['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            $xlsx = $this->openXLSX($file['tmp_name'], false);
            foreach ($xlsx->rows() as $r) {
                array_push($data, $r);
            }
            return $data;
        } elseif ($file['type'] === 'application/vnd.ms-excel') {
            $xls = $this->openXLS($file['tmp_name'], false);
            foreach ($xls->rows() as $r) {
                array_push($data, $r);
            }
            return $data;
        } else {
            throw new \Exception('Invalid file type');
        }

        return $data;
    }
}
