<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Area;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;

class AreaController extends AdminController
{
   /**
    * Title for current resource.
    *
    * @var string
    */
   protected $title = '地區';

   public function index(Content $content)
   {
      return $content
         ->header('地區')
         ->description('管理')
         ->breadcrumb(['text' => '地區管理'])
         ->body($this->grid());
   }
   /**
    * Make a grid builder.
    *
    * @return Grid
    */
   protected function grid()
   {
      $grid = new Grid(new Area());

      $grid->column('id', __('ID'));
      $grid->column('area_name', __('地區名稱'))->color('#faa86f');
      $grid->column('mod_user', __('異動人員'));
      //$grid->column('created_at', __('建立時間'));
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
      $show = new Show(Area::findOrFail($id));

      $show->field('id', __('Id'));
      $show->field('area_name', __('地區名稱'));
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
      $form = new Form(new Area());

      $uname = Admin::user()->name;

      $form->text('area_name', __('地區名稱'))->rules('required|max:30');
      $form->text('mod_user', __('異動人員'))->default($uname)->readonly();

      $form->saving(function (Form $form) {
         $form->mod_user = Admin::user()->name;
      });

      return $form;
   }
}
