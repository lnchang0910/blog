<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Pubtrans;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class PubtransController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '大眾運輸資訊';

    public function index(Content $content)
    {
        return $content
            ->header('大眾運輸資訊')
            ->description('管理')
            ->breadcrumb(['text' => '大眾運輸資訊管理'])
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pubtrans());

        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        $grid->column('id', __('Id'));
        $grid->column('station.station_name', __('測站名稱'));
        $grid->column('location_img', __('地理位置圖'))->image('', '50');
        $grid->column('thsrc', __('高鐵交通資訊'));
        $grid->column('bus', __('火車交通資訊'));
        $grid->column('railway', __('公車交通資訊'));
        //$grid->column('google_map', __('Google map'));
        //$grid->column('valid_at', __('有效日期'));
        $grid->column('mod_user', __('異動人員'));
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Pubtrans::findOrFail($id));

        $show->field('id', __('Id'));
        $show->station_id('測站')->as(function ($station_id) {
            return Station::where('id', $station_id)->first()->station_name ?? null;
        });
        $show->field('location_img', __('地理位置圖'))->image();
        $show->field('thsrc', __('高鐵交通資訊'))->unescape();
        $show->field('bus', __('火車交通資訊'))->unescape();
        $show->field('railway', __('公車交通資訊'))->unescape();
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
        $form = new Form(new Pubtrans());

        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        if($username != 'admin'){
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id)->readonly();
        } else {
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id);
        }
        $form->image('location_img', __('地理位置圖'))->help('圖片尺寸：2297*1583');
        $form->ckeditor('thsrc', __('高鐵交通資訊'));
        $form->ckeditor('nus', __('火車交通資訊'));
        $form->ckeditor('railway', __('公車交通資訊'));
        $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });

        return $form;
    }
}
