<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Mainpages;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class MainpagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '首頁設定';

    public function index(Content $content)
    {
        return $content
            ->header('首頁設定')
            ->description('管理')
            ->breadcrumb(['text' => '首頁設定管理'])
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Mainpages());
        $username = Admin::user()->username;

        //$grid->column('id', __('Id'));
        $grid->column('title', __('首頁文字'));
        $grid->column('url', __('圖片超連結'));
        $grid->column('order', __('順序'));
        $grid->column('image', __('首頁圖片'))->image('', '50');
        $grid->column('valid_at', __('有效日期'));
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
        $show = new Show(Mainpages::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('首頁文字'));
        $show->field('url', __('圖片超連結'));
        $show->field('order', __('順序'));
        $show->field('image', __('首頁圖片'))->image();
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
        $form = new Form(new Mainpages());
        $username = Admin::user()->username;

        $form->text('title', __('首頁文字'));
        $form->text('url', __('圖片超連結'));
        $form->text('order', __('順序'));
        $form->image('image', __('首頁圖片'))->help('圖片尺寸：2297*1583')->rules('required');
        $form->datetime('valid_at', __('有效日期'))->default(date('Y-m-d H:i:s'));
        $form->text('mod_user', __('異動人員'))->default(Admin::user()->name)->readonly();
        $form->saving(function (Form $form) {
            $form->mod_user = Admin::user()->name;
        });


        return $form;
    }
}
