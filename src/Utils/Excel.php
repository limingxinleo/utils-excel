<?php
// +----------------------------------------------------------------------
// | Excel.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace limx\Utils;

use PHPExcel;
use PHPExcel_IOFactory;

class Excel
{
    protected $name;

    protected $sheet;

    protected $items;

    protected $objPHPExcel;

    public function __construct()
    {
        $this->objPHPExcel = new PHPExcel();
    }

    /**
     * @desc   设置Excel的sheet
     * @author limx
     * @param      $index
     * @param null $title
     */
    public function sheet($index, $title = null)
    {
        $this->objPHPExcel->setActiveSheetIndex($index);
        if (isset($title)) {
            $this->title($title);
        }
        return $this;
    }

    /**
     * @desc   设置Excel的sheet标题
     * @author limx
     * @param $title
     */
    public function title($title)
    {
        $this->objPHPExcel->getActiveSheet()->setTitle($title);
        return $this;
    }

    /**
     * @desc   写入数据
     * @author limx
     * @param array $data
     * @return $this
     */
    public function create(array $data)
    {
        foreach ($data as $j => $item) {
            foreach ($item as $i => $value) {
                $this->objPHPExcel->getActiveSheet()
                    ->setCellValueByColumnAndRow($i, $j + 1, $value);
            }
        }

        return $this;
    }

    /**
     * @desc   保存Excel
     * @author limx
     * @param $path
     */
    public function store($pathName, $ext = 'xlsx')
    {
        switch ($ext) {
            case 'xls':
                $writer_type = 'Excel5';
                break;
            case 'xlsx':
            default:
                $writer_type = 'Excel2007';
                $ext = 'xlsx';
        }

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $writer_type);
        $objWriter->save($pathName . '.' . $ext);
    }

}