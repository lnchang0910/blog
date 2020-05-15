<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Spot;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class SpotController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '導覽景點';

    public function index(Content $content)
    {
        return $content
            ->header('導覽景點')
            ->description('管理')
            ->breadcrumb(['text' => '導覽景點管理'])
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Spot());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        //$grid->column('id', __('Id'));
        $grid->column('spot_id', __('景點編號'));
        $grid->column('bcn_id', __('Beacon 編號'));
        $grid->column('station.station_name', __('測站名稱'));
        $grid->column('floor_id', __('樓層'));
        $grid->column('spot_name', __('景點名稱'));
        $grid->column('list_image', __('列表圖'))->image('', '50');
        $grid->column('spot_excerpt', __('景點摘要'));
        //$grid->column('spot_description', __('景點內容'));
        //$grid->column('spot_image1', __('景點圖片'))->image('', '50');
        //$grid->column('spot_image2', __('景點圖片'))->image('', '50');
        //$grid->column('spot_image3', __('景點圖片'))->image('', '50');
        //$grid->column('spot_image4', __('景點圖片'))->image('', '50');
        //$grid->column('spot_image5', __('景點圖片'))->image('', '50');
        //$grid->column('spot_voice', __('語音檔位置'));
        //$grid->column('spot_mov_file', __('影片連結'));
        //$grid->column('status', __('是否啟動'));
        //$grid->column('order', __('排序'));
        //$grid->column('valid_at', __('有效日期'));
        //$grid->column('mod_user', __('異動人員'));
        //$grid->column('updated_at', __('異動時間'));

        if ($username != 'admin') {
            $grid->model()->where('station_id', '=', $station_id);
        }


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Spot::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('spot_id', __('景點編號'));
        $show->field('bcn_id', __('Beacon 編號'));
        $show->station_id('測站')->as(function ($station_id) {
            return Station::where('id', $station_id)->first()->station_name ?? null;
        });
        $show->field('floor_id', __('樓層'));
        $show->field('spot_name', __('景點名稱'));
        $show->field('list_image', __('列表圖'))->image();
        $show->field('spot_excerpt', __('景點摘要'))->unescape();
        $show->field('spot_description', __('景點內容'))->unescape();
        $show->field('spot_image1', __('景點圖片'))->image();
        $show->field('spot_image2', __('景點圖片'))->image();
        $show->field('spot_image3', __('景點圖片'))->image();
        $show->field('spot_image4', __('景點圖片'))->image();
        $show->field('spot_image5', __('景點圖片'))->image();
        $show->field('spot_voice', __('語音檔位置'))->unescape();
        $show->field('spot_mov_file', __('影片連結'))->unescape();
        $show->field('status', __('是否啟動'));
        $show->field('order', __('排序'));
        $show->field('valid_at', __('有效日期'));
        $show->field('mod_user', __('異動人員'));
        $show->field('created_at', __('建立時間'));
        $show->field('updated_at', __('異動時間'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Spot());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        $form->text('spot_id', __('景點編號'));
        $form->text('bcn_id', __('Beacon 編號'));

        if($username != 'admin'){
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id)->readonly();
        } else {
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id);
        }
        //$form->text('station_code', __('測站名稱'))->$station_code->readonly();
        $form->text('floor_id', __('樓層'));
        $form->text('spot_name', __('景點名稱'));
        $form->image('list_image', __('列表圖'))->help('圖片尺寸：2297*1583')->rules('required');
        $form->ckeditor('spot_excerpt', __('景點摘要'))->rules('required');
        $form->ckeditor('spot_description', __('景點內容'))->rules('required');

        $form->image('spot_image1', __('景點圖片'))->help('圖片尺寸：2297*1583');
        $form->image('spot_image2', __('景點圖片'))->help('圖片尺寸：2297*1583');
        $form->image('spot_image3', __('景點圖片'))->help('圖片尺寸：2297*1583');
        $form->image('spot_image4', __('景點圖片'))->help('圖片尺寸：2297*1583');
        $form->image('spot_image5', __('景點圖片'))->help('圖片尺寸：2297*1583');

        $form->text('spot_voice', __('語音檔位置'));
        $form->text('spot_mov_file', __('影片連結'));
        $form->switch('status', __('是否啟動'));
        $form->number('order', __('排序'));
        $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });


        return $form;
    }
}
