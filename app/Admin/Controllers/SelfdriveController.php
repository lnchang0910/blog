<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Selfdrive;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use App\Admin\Models\Station;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class SelfdriveController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '自行開車資訊';

    public function index(Content $content)
    {
        return $content
            ->header('自行開車資訊')
            ->description('管理')
            ->breadcrumb(['text' => '自行開車資訊管理'])
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Selfdrive());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        $grid->column('id', __('Id'));
        $grid->column('station.station_name', __('測站名稱'));
        $grid->column('parking_space', __('停車資訊'));
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
        $show = new Show(Selfdrive::findOrFail($id));

        $show->field('id', __('Id'));
        $show->station_id('測站')->as(function ($station_id) {
            return Station::where('id', $station_id)->first()->station_name ?? null;
        });
        $show->field('parking_space', __('停車資訊'))->unescape();
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
        $form = new Form(new Selfdrive());
        $station_id = Admin::user()->station_id;
        $username = Admin::user()->username;

        if($username != 'admin'){
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id)->readonly();
        } else {
            $form->select('station_id', __('測站名稱'))->options(Station::all()->pluck('station_name', 'id'))->default($station_id);
        }
        $form->ckeditor('parking_space', __('停車資訊'));
        $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });

        return $form;
    }
}
