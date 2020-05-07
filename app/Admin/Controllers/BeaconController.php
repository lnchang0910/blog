<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Beacon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class BeaconController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Beacon資訊';

    public function index(Content $content)
    {
        return $content
            ->header('Beacon資訊')
            ->description('管理')
            ->breadcrumb(['text' => 'Beacon資訊管理'])
            ->body($this->grid());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Beacon());

        //$station_id = Admin::user()->station_id;
        //$username = Admin::user()->username;

        //$grid->column('id', __('Id'));
        $grid->column('bcn_id', __('Beacon編號'));
        $grid->column('bcn_uuid', __('Beacon UUID'));
        //$grid->column('bcn_macid', __('Beacon Mac 位址'));
        $grid->column('bcn_major', __('Beacon Major'));
        $grid->column('bcn_minor', __('Beacon Minor'));
        $grid->column('bcn_rssi', __('Beacon 強度'));
        $grid->column('bcn_name', __('Beacon 名稱'));
        $grid->column('status', __('是否啟用'));
        $grid->column('mod_user', __('異動人員'));
        $grid->column('updated_at', __('異動時間'));

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
        $show = new Show(Beacon::findOrFail($id));

        //$grid->field('id', __('Id'));
        $show->field('bcn_id', __('Beacon編號'));
        $show->field('bcn_uuid', __('Beacon UUID'));
        //$show->column('bcn_macid', __('Beacon Mac 位址'));
        $show->field('bcn_major', __('Beacon Major'));
        $show->field('bcn_minor', __('Beacon Minor'));
        //$show->field('bcn_rssi', __('Beacon 強度'));
        $show->field('bcn_name', __('Beacon 名稱'));
        $show->field('status', __('是否啟用'));
        $show->field('mod_user', __('異動人員'));
        //$show->field('created_at', __('建立時間'));
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
        $form = new Form(new Beacon());

        //$station_id = Admin::user()->station_id;
        //$username = Admin::user()->username;

        $form->text('bcn_id', __('Beacon 編號'));
        $form->text('bcn_uuid', __('Beacon UUID'))->rules('required|max:256');
        $form->text('bcn_macid', __('Beacon Mac ID'))->rules('required|max:256');
        $form->text('bcn_major', __('Beacon Major'))->rules('required');
        $form->text('bcn_minor', __('Beacon Minor'))->rules('required');
        $form->text('bcn_rssi', __('Beacon 強度'))->rules('required');
        $form->text('bcn_name', __('Beacon 名稱'))->rules('required');
        $form->text('status', __('是否啟用'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });

        return $form;
    }
}
