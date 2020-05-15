<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Scenery;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class SceneryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '周邊景點';

    public function index(Content $content)
    {
        return $content
            ->header('周邊景點')
            ->description('管理')
            ->breadcrumb(['text' => '周邊景點管理'])
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Scenery());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        //$grid->column('id', __('Id'));
        $grid->column('station.station_name', __('測站名稱'));
        $grid->column('scn_id', __('景點編號'));
        $grid->column('scn_title', __('標題'));
        //$grid->column('scn_excerpt', __('景點摘要'));
        //$grid->column('list_image', __('景點列表圖'));
        $grid->column('list_image', __('景點列表圖'))->image('', '50');
        //$grid->column('scn_content', __('景點說明'));
        //$grid->column('order', __('排序'));
        //$grid->column('valid_at', __('有效日期'));
        $grid->column('mod_user', __('異動人員'));
        $grid->column('updated_at', __('異動時間'));

        if($username != 'admin'){
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
        $show = new Show(Scenery::findOrFail($id));

        $show->field('id', __('Id'));
        $show->station_id('測站')->as(function ($station_id) {
            return Station::where('id', $station_id)->first()->station_name ?? null;
        });

        $show->field('scn_id', __('景點編號'));
        $show->field('scn_title', __('標題'));
        $show->field('scn_excerpt', __('景點摘要'))->unescape();
        $show->field('list_image', __('景點列表圖'))->image();
        $show->field('scn_content', __('景點說明'))->unescape();
        $show->field('order', __('排序'));
        $show->field('valid_at', __('有效日期'));
        $show->field('mod_user', __('異動人員'));
        $show->field('updated_at', __('異動時間'));
        $show->field('created_at', __('建立時間'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Scenery());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        if($username != 'admin'){
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id)->readonly();
        } else {
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id);
        }
        //$form->text('station_code', __('測站名稱'))->$station_code->readonly();

        $form->text('scn_id', __('景點編號'))->rules('required|max:11');
        $form->text('scn_title', __('標題'));
        $form->ckeditor('scn_excerpt', __('景點摘要'))->rules('required');
        //$form->image('list_image', __('景點列表圖'));
        $form->image('list_image', __('景點列表圖'))->help('圖片尺寸：2297*1583')->rules('required');
        $form->ckeditor('scn_content', __('景點說明'))->rules('required');
        $form->text('order', __('排序'));
        $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });

        return $form;
    }
}
